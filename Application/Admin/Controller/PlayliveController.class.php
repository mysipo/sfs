<?php
namespace Admin\Controller;
use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台直播控制器
 * @author 山大王
 */
class PlayliveController extends AdminController {

	/**
     * 直播列表
     * @author 山大王
     */
    public function index(){
        $map = array('video.tch_id = bbs.uid and tutor.uid = video.tutor_id');
        if(I('cl_id')){
            $map['video.cl_id'] = I('cl_id');
            $where['cl_id'] = I('cl_id');
            $this->assign('cl_id',I('cl_id'));
        }
        if(I('status')){
            $now = date("Y-m-d H:i:s",time());
            if(I('status')==1){
                $map['video.live_start_time'] = array('lt',$now);
                $map['video.live_stop_time'] = array('gt',$now);
                $where['live_start_time'] = array('lt',$now);
                $where['live_stop_time'] = array('gt',$now);
            }elseif(I('status')==2){
                $map['video.live_start_time'] = array('gt',$now);
                $where['live_start_time'] = array('gt',$now);
            }elseif(I('status')==3){
                $map['video.live_stop_time'] = array('lt',$now);
                $where['live_stop_time'] = array('lt',$now);
            }
            $this->assign('status',I('status'));
        }
        if(I('type')){
            $map['video.live_type'] = I('type');
            $where['live_type'] = I('type');
            $this->assign('type',I('type'));
        }
        if(I('content')){
            if(I("content")==1){
                $map['video.lc_id'] = array('gt',I('content'));
                $where['lc_id'] = array('gt',I('content'));
            }else{
                $map['video.lc_id'] = array('lt',I('content'));
                $where['lc_id'] = array('lt',I('content'));
            }

            $this->assign('content',I('content'));
        }
        $live = M('live');
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $listRows = C('LIST_ROWS') > 0 ? C('LIST_ROWS') : 10;
        $count      = $live->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$listRows);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出

        $res = $live
        ->table('lesson_live video')
        ->join('mysipo_bbs.mys_common_member bbs')
        ->join('mysipo_bbs.mys_common_member tutor')
        ->where($map)
        ->field('bbs.uid,bbs.username,video.tch_id,video.live_id,live_title,video.live_start_time,video.live_stop_time,video.live_time,video.tch_id,video.lc_id,video.live_num,video.live_type,video.cl_id,video.tutor_id,bbs.username as tch_name,tutor.username as tutor_name')
        ->limit($Page->firstRow.','.$Page->listRows)
        ->order('video.live_id desc')
        ->select();
        foreach($res as $key=>$val){
            $start = strtotime($val['live_start_time']);
            $stop = strtotime($val['live_stop_time']);
            $now = time();
            if($start > $now){
                if($start < $now + 86400){
                    $val['status'] = 4;//直播即将开始
                }else{
                    $val['status'] = 1;//直播未开始
                }
            }else if($stop < $now){
                $val['status'] = 3;//直播已结束
            }else if($start < $now && $stop > $now){
                $val['status'] = 2;//直播中
            }
            $val['sub_title'] = $val['live_title'];
            if(strlen($val['live_title'])>24)$val['live_title']=mb_substr($val['live_title'], 0,8,'utf-8').'...';
            $list[] = $val;
        }

        $class = M('class')->field('cl_id,cl_title')->order('cl_sort desc,cl_id desc')->select();
        $this->assign('select',1);
        $this->assign('class',$class);
        $this->assign('_page',$show);// 赋值分页输出
        $this->assign('list', $list);
        $this->meta_title = '直播管理';
        $this->display();
    }

    /**
     * 添加直播
     * @author 山大王
     */
    public function add(){
        if(IS_POST){
            $live = D('Playlive');
            $data = $live->create();
            if($data){
                if($data['live_start_time'] > $data['live_stop_time']){
                    $this->error('开始时间不能大于结束时间');
                }
                $live = M('live')->where(array('live_title'=>$data['live_title']))->getField();
                if($live){
                    $this->error('课程名称重复');
                }
                $user = new \Admin\Model\UserModel();
                //获取讲师uid
                $where = array('username'=>$data['tch_id']);
                $tch = $user->getUserID($where);
                if(!$tch){
                    $this->error('讲师用户不存在');
                }else{
                    $data['tch_id'] = $tch['uid'];
                }

                //获取助教uid
                if($data['tutor_id']){
                    $where = array('username'=>$data['tutor_id']);
                    $tutor = $user->getUserID($where);
                    if(!$tutor){
                        $this->error('助教用户不存在');
                    }else{
                        $data['tutor_id']   = $tutor['uid'];
                    }
                }else{
                    $data['tutor_id'] = 112653;
                }
                $uri = "http://mysipo.gensee.com/integration/site/training/room/created";
                $gensee = $this->gensee($data['live_title'],$live_start_time,$uri);
                if($gensee->code!=0){
                    $this->error($gensee->message);
                }else{
                    $data['live_key'] = $gensee->id;
                    $data['live_tutor_key'] = $gensee->assistantToken;
                    $data['live_stu_key'] = $gensee->studentClientToken;
                    $data['live_tch_key'] = $gensee->teacherToken;
                    $data['live_code']  = $gensee->number;
                    $data['live_time']  = date('Y-m-d H:i:s',time());
                    $data['uid'] =   UID;

                    $file = ".".$data['live_img'];
                    if(file_exists($file)){
                        $tag = explode('.', $data['live_img']);
                        $newfile = "Uploads/live/".time().'.'.array_pop($tag);
                        copy($file, $newfile);
                        unlink($file);
                        $data['live_img'] = '/'.$newfile;
                    }
                    $id = $live->add($data);
                    if($id){
                        $this->success('新增成功', U('index'));
                        //记录行为
                        action_log('update_live', 'live', $id, UID);
                    } else {
                        $this->error('新增失败');
                    }
                }

            } else {
                $this->error($live->getError());
            }
        } else {
            $class = M('class')->field('cl_id,cl_title')->order('cl_sort desc,cl_id desc')->select();
            $this->assign('class',$class);
            $this->assign('info',null);
            $this->meta_title = '新增直播';
            $this->display('edit');
        }
    }

    /**
     * 编辑直播
     * @author 山大王
     */
    public function edit($id = 0){
        if(IS_POST){
            $live = D('Playlive');
            $data = $live->create();
            if($data){
                if($data['live_start_time'] > $data['live_stop_time']){
                    $this->error('开始时间不能大于结束时间');
                }
                $live = M('live')->where(array('live_title'=>$data['live_title']))->getField();
                if($live && $live!=$data['live_id']){
                    $this->error('课程名称重复');
                }
                $user = new \Admin\Model\UserModel();
                //获取讲师uid
                $where = array('username'=>$data['tch_id']);
                $tch = $user->getUserID($where);
                if(!$tch){
                    echo $user->getLastSql();
                    die();
                    //$this->error('讲师用户不存在');
                }else{
                    $data['tch_id'] = $tch['uid'];
                }
                //获取助教uid
                if($data['tutor_id']){
                    $where = array('username'=>$data['tutor_id']);
                    $tutor = $user->getUserID($where);
                    if(!$tutor){
                        $this->error('助教用户不存在');
                    }else{
                        $data['tutor_id']   = $tutor['uid'];
                    }
                }else{
                    $data['tutor_id'] = 112653;
                }
                if($data['live_img']!=I('old_live_img')){
                    $file = ".".$data['live_img'];
                    if(file_exists($file)){
                        $tag = explode('.', $data['live_img']);
                        $newfile = "Uploads/live/".time().'.'.array_pop($tag);
                        copy($file, $newfile);
                        unlink($file);
                        unlink('.'.I('old_live_img'));
                        $data['live_img'] = '/'.$newfile;
                    }
                }
                if($live->save($data)){
                    //记录行为
                    action_log('update_Live', 'Live', $data['live_id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $this->error($live->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('live')->table('lesson_live video')
            ->join('mysipo_bbs.mys_common_member bbs')
            ->join('mysipo_bbs.mys_common_member tutor')
            ->where('video.tch_id = bbs.uid and tutor.uid = video.tutor_id and video.live_id = '.$id)
            ->field('video.*,bbs.username as tch_name,tutor.username as tutor_name')
            ->find();
            if(false === $info){
                $this->error('获取配置信息错误');
            }
            $class = M('class')->field('cl_id,cl_title')->order('cl_sort desc,cl_id desc')->select();
            $this->assign('class',$class);
            $this->assign('info', $info);
            $this->meta_title = '编辑直播';
            $this->display();
        }
    }

    public function update(){
        if(IS_POST){
            $live = M('live')->save($_POST);
            if($live){
                echo 1;
            }else{
                echo 2;
            }
        }
    }

    /**
     * 创建课程频道
     * @author 山大王
     */
    public function content(){
        if(IS_POST){
            $data['lc_speak'] = I('lc_speak');
            if(!$data['lc_speak']) $this->error('请填写主讲人姓名');
            $data['lc_img'] = I('lc_img');
            if(!$data['lc_img']) $this->error('请上传标志图');
            $data['live_id'] = I('live_id');
            if(!$data['live_id']) $this->error('请选择一节课程');
            $data['lc_time'] = date("Y-m-d H:i:s",time());
            $data['uid'] = UID;
            $data['place_id'] = I('place_id');
            if(!$data['place_id']) $this->error('请选择开课地点');
            $data['lc_speak_intr'] = I('lc_speak_intr');
            $data['lc_content'] = I('lc_content');
            $data['lc_outline'] = I('lc_outline');
            $data['lc_id'] = I('lc_id');
            if($data['lc_id']){
                if($data['lc_img']!=I('old_lc_img')){
                    $file = ".".$data['lc_img'];
                    if(file_exists($file)){
                        $tag = explode('.', $data['lc_img']);
                        $newfile = "Uploads/live/".time().'.'.array_pop($tag);
                        copy($file, $newfile);
                        unlink($file);
                        unlink('.'.I('old_lc_img'));
                        $data['lc_img'] = '/'.$newfile;
                    }
                }
                $cont = M('live_content')->save($data);
                if($cont){
                    $this->success('编辑成功', U('index'));
                }else{
                    $this->error('编辑失败');
                }
            }else{
                $file = ".".$data['lc_img'];
                if(file_exists($file)){
                    $tag = explode('.', $data['lc_img']);
                    $newfile = "Uploads/live/".time().'.'.array_pop($tag);
                    copy($file, $newfile);
                    unlink($file);
                    $data['lc_img'] = '/'.$newfile;
                }
                $cont = M('live_content')->add($data);
                if($cont){
                    $arr = array('live_id'=>$data['live_id'],'lc_id'=>$cont);
                    M('live')->save($arr);
                    $this->success('新增成功', U('index'));
                }else{
                    $this->error('新增失败');
                }
            }

        }else{
            $id = I('id');
            $cont = M('live_content')->where(array('live_id'=>$id))->find();
            if($cont){
                $this->assign('info',$cont);
            }

            $live = M('live')->where(array('live_id'=>$id))->field('live_id,live_title,lc_id')->find();
            $place = M('place')->select();
            $this->assign('place',$place);
            $this->meta_title = '直播频道';
            $this->assign('live',$live);
            $this->display();
        }
    }

    /**
     * 删除直播
     * @author 山大王
     */
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('live_id' => array('in', $id) );
        if(M('live')->where($map)->delete()){
            //记录行为
            action_log('update_Playlive', 'Playlive', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    /**
     * 文档排序
     * @author 山大王
     */
    public function sort(){
        if(IS_GET){
            //获取左边菜单
            $this->getMenu();

            $ids        =   I('get.ids');
            $cate_id    =   I('get.cate_id');
            $pid        =   I('get.pid');

            //获取排序的数据
            $map['status'] = array('gt',-1);
            if(!empty($ids)){
                $map['id'] = array('in',$ids);
            }else{
                if($cate_id !== ''){
                    $map['category_id'] = $cate_id;
                }
                if($pid !== ''){
                    $map['pid'] = $pid;
                }
            }
            $list = M('Document')->where($map)->field('id,title')->order('level DESC,id DESC')->select();

            $this->assign('list', $list);
            $this->meta_title = '文档排序';
            $this->display();
        }elseif (IS_POST){
            $ids = I('post.ids');
            $ids = array_reverse(explode(',', $ids));
            foreach ($ids as $key=>$value){
                $res = M('Document')->where(array('id'=>$value))->setField('level', $key+1);
            }
            if($res !== false){
                $this->success('排序成功！');
            }else{
                $this->eorror('排序失败！');
            }
        }else{
            $this->error('非法请求！');
        }
    }

}
