<?php
namespace Admin\Controller;

/**
 * 后台录播控制器
 * @author 山大王
 */

class VideoController extends AdminController {

    /**
     * 分类列表
     * @author 山大王
     */
    public function index(){

        $map = array('video.tch_id = bbs.uid and tutor.uid = video.tutor_id');
        $video = M('video');
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $listRows = C('LIST_ROWS') > 0 ? C('LIST_ROWS') : 10;
        $count      = $video->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$listRows);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出

        $res = $video
        ->table('lesson_video video')
        ->join('mysipo_bbs.mys_common_member bbs')
        ->join('mysipo_bbs.mys_common_member tutor')
        ->where($map)
        ->field('video.*,bbs.uid,bbs.username as tch_name,tutor.username as tutor_name')
        ->limit($Page->firstRow.','.$Page->listRows)
        ->order('video.video_id desc')
        ->select();
        $live = M('live');
        foreach($res as $key=>$val){
            $val['sub_title'] = $val['title'];
            if($val['live_id']!=0){
                $title = $live->where(array('live_id'=>$val['live_id']))->field('live_title')->find();
                if($title){
                    $val['live_title'] = $title['live_title'];
                    $val['sub_live'] = $val['live_title'];
                    if(strlen($val['live_title'])>30){
                        $val['live_title'] = mb_substr($val['live_title'], 0,12,'utf-8').'...';
                    }
                }else{
                    $val['live_title'] = '';
                }
            }else{
                $val['live_title'] = '';
            }
            if(strlen($val['title'])>36){
                $val['title'] = mb_substr($val['title'], 0,12,'utf-8').'...';
            }
            $list[] = $val;
        }
        $this->assign('_page',$show);// 赋值分页输出
        $this->assign('list', $list);
        $this->meta_title = '录播管理';
        $this->display();
    }

    /**
     * 添加录播
     * @author 山大王
     */
    public function add(){
        if(IS_POST){
            $video = D('Video');
            $data = $video->create();
            if($data){
                $title = M('video')->where(array('title'=>$data['title']))->getField();
                if($title)$this->error('标题已存在');
                if($data['live_id']&&$data['live_id']!=''){
                    $data['live_id'] = M('live')->where(array('live_title'=>$data['live_id']))->getField();
                    if(!$data['live_id']) $this->error('直播课程不存在');

                    $live = M('video')->where(array('live_id'=>$data['live_id']))->getField();
                    if($live)$this->error('直播课程已被添加');
                }
                $data['price'] = (float)$data['price'];
                $data['create_time'] = time();
                $data['update_time'] = time();
                $data['uid'] = UID;
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
                $id = $video->add($data);
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_Class', 'Class', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($video->getError());
            }
        } else {
            $class = M('class')->field('cl_id,cl_title')->order('cl_sort desc,cl_id desc')->select();
            $this->assign('class',$class);
            $this->assign('info',null);
            $this->meta_title = '新增录播';
            $this->display('edit');
        }
    }

    /**
     * 编辑分类
     * @author 山大王
     */
    public function edit($id = 0){
        if(IS_POST){
            $video = D('Video');
            $data = $video->create();
            if($data){
                $title = M('video')->where(array('title'=>$data['title']))->getField();
                if($title&&$title!=$data['video_id'])$this->error('标题已存在');
                if($data['live_id']&&$data['live_id']!=''){
                    $data['live_id'] = M('live')->where(array('live_title'=>$data['live_id']))->getField();
                    if(!$data['live_id']) $this->error('直播课程不存在');

                    $live = M('video')->where(array('live_id'=>$data['live_id']))->getField();
                    if($live&&$live!=$data['video_id'])$this->error('直播课程已被添加');
                }
                $data['price'] = (float)$data['price'];
                $data['update_time'] = time();
                $data['uid'] = UID;
                $user = new \Admin\Model\UserModel();
                //获取讲师uid
                $where = array('username'=>$data['tch_id']);
                $tch = $user->getUserID($where);
                if(!$tch){
                    dump($data);
                    exit;
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
                $id = $video->save($data);
                if($id){
                    $this->success('编辑成功', U('index'));
                    //记录行为
                    action_log('update_Video', 'Video', $id, UID);
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $this->error($video->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('video')->table('lesson_video video')
            ->join('mysipo_bbs.mys_common_member bbs')
            ->join('mysipo_bbs.mys_common_member tutor')
            ->where('video.tch_id = bbs.uid and tutor.uid = video.tutor_id and video.video_id = '.$id)
            ->field('video.*,bbs.username as tch_name,tutor.username as tutor_name')
            ->find();
            if(false === $info){
                $this->error('获取配置信息错误');
            }
            if($info['live_id']==0){
                $info['live_id']='';
            }else{
                $live = M('live')->where(array('live_id'=>$info['live_id']))->field('live_title')->find();
                if($live){
                    $info['live_id'] = $live['live_title'];
                }else{
                    $info['live_id'] = '';
                }
            }
            $class = M('class')->field('cl_id,cl_title')->order('cl_sort desc,cl_id desc')->select();
            $this->assign('class',$class);
            $this->assign('info', $info);
            $this->meta_title = '编辑录播';
            $this->display();
        }
    }

    /**
     * 删除录播
     * @author 山大王
     */
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('video_id' => array('in', $id) );
        if(M('video')->where($map)->delete()){
            //记录行为
            action_log('update_Video', 'Video', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    /**
    * 录播视频列表
    * @author   山大王
    */

    public function video_list(){
        $id = I('id');
        if(!$id)$this->error('参数错误');

        /* 获取录播视频列表 */
        $map = array('video_id'=>$id);
        $res   = $this->lists('video_node', $map ,'node_id desc');
        foreach($res as $key=>$val){
            $val['subtitle'] = $val['node_title'];
            if(strlen($val['node_title'])>30){
                $val['node_title'] = mb_substr($val['node_title'], 0,30,'utf-8').'...';
            }
            $list[] = $val;
        }
        $this->assign('list', $list);
        $this->assign('video_id',$id);
        $this->meta_title = '录播管理';
        $this->display();

    }

    /**
      * 添加录播章节
      * @author 山大王
    */

    public function video_add(){
        if(IS_POST){
            /*接受数据 start*/
            $data['node_title'] = I('node_title',1);
            $data['qcloud_id']  = I('qcloud_id');
            $data['qcloud_app'] = I('qcloud_app');
            $data['video_id']   = I('video_id');
            $data['create_time'] = time();
            /*接受数据 end*/

            /*数据判断 start*/
            if(!$data['node_title'])$this->error('必须填写视频名称');
            if(!$data['qcloud_id'])$this->error('必须填写视频标识');
            if(!$data['qcloud_app'])$this->error('必须填写视频ID');
            /*数据判断 end*/

            /*判断同一节课内视频标题和视频标识不能重复 start*/
            $title = M('video_node')->where(array('node_title'=>$data['node_title'],'video_id'=>$data['video_id']))->getField();
            if($title)$this->error('视频名称重复');

            $qcloud_id = M('video_node')->where(array('qcloud_id'=>$data['qcloud_id'],'video_id'=>$data['video_id']))->getField();
            if($qcloud_id)$this->error('视频标识重复');
            /*判断同一节课内视频标题和视频标识不能重复 end*/

            if(strlen($data['qcloud_id'])!=20)$this->error('视频标识长度不正确');
            /*插入数据*/
            $res = M('video_node')->add($data);

            if($res){
                $this->success('添加成功',U('Video/video_list',array('id'=>$data['video_id'])));
            }else{
                $this->error('添加失败');
            }

        }else{
            $info['video_id'] = I('video_id');
            if(!$info['video_id'])$this->error('参数错误');
            $this->assign('info',$info);
            $this->meta_title = '新增系列课程';
            $this->display('video_edit');
        }

    }

    /**
      * 编辑录播章节
      * @author 山大王
    */

    public function video_edit(){
        if(IS_POST){

            $data['node_title'] = I('node_title',1);
            $data['qcloud_id']  = I('qcloud_id');
            $data['qcloud_app'] = I('qcloud_app');
            $data['video_id']   = I('video_id');
            $data['node_id']    = I('node_id');
            $data['create_time'] = time();

            if(!$data['node_title'])$this->error('必须填写视频名称');
            if(!$data['qcloud_id'])$this->error('必须填写视频标识');
            if(!$data['qcloud_app'])$this->error('必须填写视频ID');
            /*判断同一节课内视频标题和视频标识不能重复 start*/
            $title = M('video_node')->where(array('node_title'=>$data['node_title'],'video_id'=>$data['video_id']))->getField();
            if($title&&$title!=$data['node_id'])$this->error('视频名称重复');

            $qcloud_id = M('video_node')->where(array('qcloud_id'=>$data['qcloud_id'],'video_id'=>$data['video_id']))->getField();
            if($qcloud_id&&$qcloud_id!=$data['node_id'])$this->error('视频标识重复');
            /*判断同一节课内视频标题和视频标识不能重复 end*/
            if(strlen($data['qcloud_id'])!=20)$this->error('视频标识长度不正确');

            $res = M('video_node')->save($data);

            if($res){
                $this->success('编辑成功',U('Video/video_list',array('id'=>$data['video_id'])));
            }else{
                $this->error('编辑失败');
            }

        }else{
            $id = I('id');
            $info = M('video_node')->where(array('node_id'=>$id))->find();
            $this->assign('info',$info);
            $this->meta_title = '编辑系列课程';
            $this->display('video_edit');
        }

    }

    /**
     * 删除录播视频
     * @author 山大王
     */
    public function video_del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('node_id' => array('in', $id) );
        if(M('video_node')->where($map)->delete()){
            //记录行为
            action_log('update_Video', 'Video', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}
