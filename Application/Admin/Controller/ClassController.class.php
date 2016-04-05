<?php
namespace Admin\Controller;

/**
 * 后台分类控制器
 * @author 山大王
 */

class ClassController extends AdminController {

    /**
     * 分类列表
     * @author 山大王
     */
    public function index(){
        $series = M('series');
        $live = M('live');
        $theme = M('theme');
        $video = M('video');
        /* 获取分类列表 */
        $map = array();
        $class   = $this->lists('class', $map ,'cl_sort desc,cl_id desc');
        foreach($class as $key=>$val){
            $val['series_num'] = $series->where(array('cl_id'=>$val['cl_id']))->count();
            $val['live_num'] = $live->where(array('cl_id'=>$val['cl_id']))->count();
            $val['video_num'] = $video->where(array('cl_id'=>$val['cl_id']))->count();
            $val['theme_num'] = $theme->where(array('cl_id'=>$val['cl_id']))->count();
            $list[] = $val;
        }
        $this->assign('list', $list);
        $this->meta_title = '分类管理';
        $this->display();
    }

    /**
     * 添加分类
     * @author 山大王
     */
    public function add(){
        if(IS_POST){
            $Class = D('Class');
            $data = $Class->create();
            if($data){

                if(M('class')->where(array('cl_title'=>$data['cl_title']))->getField())
                    $this->error('分类名称重复');
                $data['cl_time'] = date('Y-m-d H:i:s',$data['cl_time']);

                $id = $Class->add($data);
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_Class', 'Class', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Class->getError());
            }
        } else {

            $this->assign('pid', $pid);
            $this->assign('info',null);
            $this->meta_title = '新增分类';
            $this->display('edit');
        }
    }

    /**
     * 编辑分类
     * @author 山大王
     */
    public function edit($id = 0){
        if(IS_POST){
            $Class = D('Class');
            $data = $Class->create();
            if($data){
                $cl_id = M('class')->where(array('cl_title'=>$data['cl_title']))->getField();
                if($cl_id && $cl_id!=$data['cl_id']){
                    $this->error('分类名称重复');
                }
                if($Class->save()){
                    //记录行为
                    action_log('update_Class', 'Class', $data['cl_id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $this->error($Class->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Class')->find($id);
            if(false === $info){
                $this->error('获取配置信息错误');
            }
            $this->assign('info', $info);
            $this->meta_title = '编辑分类';
            $this->display();
        }
    }

    /**
     * 删除分类
     * @author 山大王
     */
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('cl_id' => array('in', $id) );
        if(M('Class')->where($map)->delete()){
            //记录行为
            action_log('update_Class', 'Class', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

}
