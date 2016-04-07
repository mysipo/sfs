<?php
namespace Admin\Controller;
use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台课程主题控制器
 * @author 山大王
 */
class ThemeController extends AdminController {

    /**
     * 系列列表
     * @author 山大王
     */
    public function index(){

        $map = array('t.uid = bbs.uid','t.cl_id = class.cl_id');
        if(I('cl_id')){
            $map['t.cl_id'] = I('cl_id');
            $where['cl_id'] = I('cl_id');
            $this->assign('cl_id',I('cl_id'));
        }
        $theme = M('theme');
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $listRows = C('LIST_ROWS') > 0 ? C('LIST_ROWS') : 10;
        $count      = $theme->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$listRows);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $list = $theme
                ->table('lesson_theme t')
                ->join('mysipo_bbs.mys_common_member bbs')
                ->join('lesson_class class')
                ->where($map)
                ->field('t.*,bbs.username,class.cl_title')
                ->limit($Page->firstRow.','.$Page->listRows)
                  ->select();
        $class = M('class')->field('cl_id,cl_title')->order('cl_sort desc,cl_id desc')->select();
        $this->assign('class',$class);
        $this->assign('_page',$show);// 赋值分页输出
        $this->assign('list', $list);
        $this->meta_title = '系列管理';
        $this->display();
    }

    /**
     * 添加系列
     * @author 山大王
     */
    public function add(){
        if(IS_POST){
            $theme = D('theme');
            $data = $theme->create();
            if($data){
                $data['t_time'] = date("Y-m-d H:i:s",time());
                $data['uid'] = UID;
                $id = $theme->add($data);
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_theme', 'theme', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($theme->getError());
            }
        } else {
            $class = M('class')->field('cl_id,cl_title')->order('cl_sort desc,cl_id desc')->select();
            $this->assign('class',$class);
            $this->assign('info',null);
            $this->meta_title = '新增系列';
            $this->display('edit');
        }
    }

    /**
     * 编辑系列
     * @author 山大王
     */
    public function edit($id = 0){
        if(IS_POST){
            $theme = D('theme');
            $data = $theme->create();
            if($data){
                if($theme->save()){
                    //记录行为
                    action_log('update_theme', 'theme', $data['ser_id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $this->error($theme->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('theme')->find($id);

            if(false === $info){
                $this->error('获取配置信息错误');
            }
            $class = M('class')->field('cl_id,cl_title')->order('cl_sort desc,cl_id desc')->select();
            $this->assign('class',$class);
            $this->assign('info', $info);
            $this->meta_title = '编辑系列';
            $this->display();
        }
    }

    /**
     * 删除系列
     * @author 山大王
     */
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('t_id' => array('in', $id) );
        if(M('theme')->where($map)->delete()){
            //记录行为
            action_log('update_theme', 'theme', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }


    /**
      * 添加系列课程
      * @author 山大王
    */

    public function add_live(){
        if(IS_POST){
            $data['live_type'] = I('live_type',1);
            $data['t_id'] = I('t_id');
            $data['ti_type'] = 2;
            $data['t_time'] = date("Y-m-d H:i:s",time());
            $data['uid'] = UID;
            $live_title = I('live_title');
            if($data['live_type']==1){
                $data['typeid'] = M('live')->where(array('live_title'=>$live_title))->getField();
                if($data['typeid']){
                    $theme_info = M('theme_info')->where(array('t_id'=>$data['t_id'],'live_type'=>1,'typeid'=>$data['typeid'],'ti_type'=>2))->getField();
                    if($theme_info) $this->error('已经添加过此课程');

                    $res = M('theme_info')->add($data);
                    if($res){
                        $this->success('添加成功');
                    }else{
                        $this->error('添加失败');
                    }

                }else{
                    $this->error("没有找到课程");
                }
            }elseif($data['live_type']==2){

                $data['typeid'] = M('video')->where(array('title'=>$live_title))->getField();
                if($data['typeid']){
                    $theme_info = M('theme_info')->where(array('t_id'=>$data['t_id'],'live_type'=>2,'typeid'=>$data['typeid'],'ti_type'=>2))->getField();
                    if($theme_info) $this->error('已经添加过此课程');

                    $res = M('theme_info')->add($data);
                    if($res){
                        $this->success('添加成功');
                    }else{
                        $this->error('添加失败');
                    }

                }else{
                    $this->error("没有找到课程");
                }
            }

        }else{
            $t_id = I('id');
            $theme = M('theme')->where(array('t_id'=>$t_id))->field('t_id,t_title')->find();
            $live = M('theme_info')
            ->table('lesson_theme_info t')
            ->join('lesson_live lv')
            ->join('mysipo_bbs.mys_common_member author')
            ->where("t.t_id = ".$t_id." and lv.live_id=t.typeid and t.uid = author.uid and t.ti_type = 2 and t.live_type = 1")
            ->field('lv.live_id,lv.live_title,t.ti_type,author.username,t.t_time,t.ti_id,t.live_type')
            ->order('t.ti_id desc')
            ->select();
            if(!$live){
                $live = array();
            }
            $video = M('theme_info')
            ->table('lesson_theme_info t')
            ->join('lesson_video video')
            ->join('mysipo_bbs.mys_common_member author')
            ->where("t.t_id = ".$t_id." and video.video_id=t.typeid and t.uid = author.uid and t.ti_type = 2 and t.live_type = 2")
            ->field('video.video_id as live_id,video.title as live_title,t.ti_type,author.username,t.t_time,t.ti_id,t.live_type')
            ->order('t.ti_id desc')
            ->select();
            if(!$video){
                $video = array();
            }
            $arr = array_merge($live,$video);
            $live_json = M('live')->field('live_id,live_title')->select();
            $live_json = json_encode($live_json);
            $str1 = "var live = ".$live_json;
            $video_json = json_encode(M('video')->field('video_id as live_id,title as live_title')->select());
            $video_file = fopen("Public/Admin/json/datas.js", "w+");
            $str2 = "var video = ".$video_json;
            fwrite($video_file, $str1."\n".$str2);
            fclose($video_file);

            foreach($arr as $key=>$val){
                $val['sub_title'] = $val['live_title'];
                if(strlen($val['live_title'])>45){
                    $val['live_title'] = mb_substr($val['live_title'], 0,15 ,'utf-8').'...';
                }
                $list[] = $val;
            }
            $this->assign('live',$list);
            $this->assign('theme',$theme);
            $this->meta_title = '新增系列课程';
            $this->display();
        }

    }


    /**
     * 删除系列课程
     * @author 山大王
     */
    public function del_live(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('ti_id' => array('in', $id) );
        if(M('theme_info')->where($map)->delete()){
            //记录行为
            action_log('update_theme', 'theme', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    //添加系列
    public function add_series(){
        if(IS_POST){
            $data['live_type'] = I('live_type',0);
            $data['t_id'] = I('t_id');
            $data['ti_type'] = 1;
            $data['t_time'] = date("Y-m-d H:i:s",time());
            $data['uid'] = UID;
            $ser_title = I('ser_title');
            $data['typeid'] = M('series')->where(array('ser_title'=>$ser_title))->getField();
            if($data['typeid']){
                $theme_info = M('theme_info')->where(array('t_id'=>$data['t_id'],'typeid'=>$data['typeid'],'ti_type'=>1))->getField();
                if($theme_info) $this->error('已经添加过此课程');

                $res = M('theme_info')->add($data);
                if($res){
                    $this->success('添加成功');
                }else{
                    $this->error('添加失败');
                }

            }else{
                $this->error("没有找到课程");
            }

        }else{
            $t_id = I('id');
            $theme = M('theme')->where(array('t_id'=>$t_id))->field('t_id,t_title')->find();
            $series = M('theme_info')
            ->table('lesson_theme_info t')
            ->join('lesson_series ser')
            ->join('mysipo_bbs.mys_common_member author')
            ->where("t.t_id = ".$t_id." and ser.ser_id=t.typeid and t.uid = author.uid and t.ti_type = 1")
            ->field('ser.*,t.ti_type,author.username,t.t_time,t.ti_id,t.live_type')
            ->order('t.ti_id desc')
            ->select();

            $ser_json = json_encode(M('series')->field('cl_id,ser_level,ser_title')->select());
            $ser_file = fopen("Public/Admin/json/series.js", "w+");
            $str = "var series = ".$ser_json;
            fwrite($ser_file, $str);
            fclose($ser_file);

            foreach($series as $key=>$val){
                $val['sub_title'] = $val['ser_title'];
                if(strlen($val['ser_title'])>45){
                    $val['ser_title'] = mb_substr($val['ser_title'], 0,15 ,'utf-8').'...';
                }
                $list[] = $val;
            }

            $class = M('class')->field('cl_id,cl_title')->select();
            $this->assign('series',$list);
            $this->assign('class',$class);
            $this->assign('theme',$theme);
            $this->meta_title = '新增系列课程';
            $this->display();
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
