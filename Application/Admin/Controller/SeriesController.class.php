<?php
namespace Admin\Controller;
use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台课程系列控制器
 * @author 山大王
 */
class SeriesController extends AdminController {

	/**
     * 系列列表
     * @author 山大王
     */
    public function index(){

        $map = array('ser.uid = bbs.uid','ser.cl_id = class.cl_id');
        if(I('cl_id')){
            $map['ser.cl_id'] = I('cl_id');
            $where['cl_id'] = I('cl_id');
            $this->assign('cl_id',I('cl_id'));
        }
        $series = M('series');
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $listRows = C('LIST_ROWS') > 0 ? C('LIST_ROWS') : 10;
        $count      = $series->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$listRows);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $list = $series
                ->table('lesson_series ser')
                ->join('mysipo_bbs.mys_common_member bbs')
                ->join('lesson_class class')
                ->where($map)
                ->field('ser.*,bbs.username,class.cl_title')
                ->limit($Page->firstRow.','.$Page->listRows)
                ->order('ser.ser_sort desc,ser.ser_id desc')
                ->select();
        foreach($list as $key=>$val){
            if(strlen($val['ser_title']) > 30){
                $val['ser_title'] = mb_substr($val['ser_title'], 0,15,'utf-8').'...';
            }
        }
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
            $series = D('series');
            $data = $series->create();
            if($data){
                $data['ser_time'] = date("Y-m-d H:i:s",time());
                $data['uid'] = UID;
                if($data['price']) ltrim($data['price'],'-');
                if($data['ser_num']) ltrim($data['ser_num']);
                $id = $series->add($data);
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_series', 'series', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($series->getError());
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
            $Series = D('series');
            $data = $Series->create();
            if($data){
                if($Series->save()){
                    //记录行为
                    action_log('update_Series', 'Series', $data['ser_id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $this->error($Series->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Series')->find($id);

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

        $map = array('ser_id' => array('in', $id) );
        if(M('series')->where($map)->delete()){
            //记录行为
            action_log('update_Series', 'Series', $id, UID);
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
            $data['ser_id'] = I('ser_id');
            $data['sc_time'] = date("Y-m-d H:i:s",time());
            $data['uid'] = UID;
            $live_title = I('live_title');
            if($data['live_type']==1){
                $data['live_id'] = M('live')->where(array('live_title'=>$live_title))->getField();
                if($data['live_id']){
                    $series_class = M('series_class')->where(array('live_type'=>1,'ser_id'=>$data['ser_id'],'live_id'=>$data['live_id']))->getField();
                    if($series_class) $this->error('已经添加过此课程');

                    $res = M('series_class')->add($data);
                    if($res){
                        $this->success('添加成功');
                    }else{
                        $this->error('添加失败');
                    }

                }else{
                    $this->error("没有找到课程");
                }
            }elseif($data['live_type']==2){

                $data['live_id'] = M('video')->where(array('title'=>$live_title))->getField();
                if($data['live_id']){
                    $series_class = M('series_class')->where(array('live_type'=>2,'ser_id'=>$data['ser_id'],'live_id'=>$data['live_id']))->getField();
                    if($series_class) $this->error('已经添加过此课程');

                    $res = M('series_class')->add($data);
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
            $ser_id = I('id');
            $series = M('series')->where(array('ser_id'=>$ser_id))->field('ser_id,ser_title')->find();
            $live = M('series_class')
            ->table('lesson_series_class ser')
            ->join('lesson_live lv')
            ->join('mysipo_bbs.mys_common_member author')
            ->where("ser.ser_id = ".$ser_id." and lv.live_id=ser.live_id and ser.uid = author.uid and ser.live_type = 1")
            ->field('lv.live_id,lv.live_title,ser.live_type,author.username,ser.sc_time,ser.sc_id')
            ->order('ser.sc_id desc')
            ->select();
            if(!$live){
                $live = array();
            }
            $video = M('series_class')
                    ->table('lesson_series_class ser')
                    ->join('lesson_video video')
                    ->join('mysipo_bbs.mys_common_member author')
                    ->where("ser.ser_id = ".$ser_id." and video.video_id=ser.live_id and ser.uid=author.uid and ser.live_type = 2")
                    ->field('video.video_id as live_id,video.title as live_title,ser.live_type,author.username,ser.sc_time,ser.sc_id')
                    ->order('ser.sc_id desc')
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
                if(strlen($val['live_title'])>30){
                    $val['live_title'] = mb_substr($val['live_title'], 0,15,'utf-8').'...';
                }
                $list[] = $val;
            }
            $this->assign('live',$list);
            $this->assign('series',$series);
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

        $map = array('sc_id' => array('in', $id) );
        if(M('series_class')->where($map)->delete()){
            //记录行为
            action_log('update_Series', 'Series', $id, UID);
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
