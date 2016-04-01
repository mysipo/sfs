<?php
namespace Admin\Controller;
use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台支付控制器
 * @author 山大王
 */
class PayinfoController extends AdminController {

	/**
     * 订单列表
     * @author 山大王
     */
    public function index(){

        $map = array();
        $list   = $this->lists('order', $map);
        $this->assign('list', $list);
        $this->meta_title = '订单管理';
        $this->display();
    }

    /**
     * 添加系列
     * @author 山大王
     */
    public function add(){
        if(IS_POST){
            $order = D('Payinfo');
            $data = $order->create();
            if($data){

                $data['status'] = I('status');
                $data['lesson_type'] = I('lesson_type');
                $data['telphone'] = I('lesson_type');
                if($data['lesson_type']==1){

                    $data['lesson_id'] = I('series_id');
                    $data['live_type'] = 0;

                }elseif($data['lesson_type']==2){

                    $data['live_type'] = I('live_type');
                    if($data['live_type']==1){
                        $data['lesson_id'] = I('live_id');
                    }elseif($data['live_type']==2){
                        $data['lesson_id'] = I('video_id');
                    }

                }
                $where['lesson_type'] = $data['lesson_type'];
                $where['live_type'] = $data['live_type'];
                $where['uname'] = $data['uname'];
                $where['lesson_id'] = $data['lesson_id'];
                if(M('order')->where($where)->getField())
                    $this->error('用户已经购买');
                $user = new \Admin\Model\UserModel();
                //获取讲师uid
                $where = array('username'=>$data['uname']);
                $info = $user->getUserID($where);
                if(!$info){
                    $this->error('用户不存在');
                }else{
                    $data['uid'] = $info['uid'];
                }
                $data['pay_time'] = time();
                $data['failure_time'] = time();
                $data['admin_id'] = UID;
                $id = $order->add($data);
                if($id){
                    $payinfo['order_on'] = $id;
                    $payinfo['bankname'] = I('bankname');
                    $payinfo['username'] = I('username');
                    $payinfo['card_id'] = I('card_id');
                    $payinfo['fee'] = I('pay_fee');
                    $payinfo['pay_amount'] = I('pay_amount');
                    $payinfo['admin_id'] = UID;
                    $payinfo['description'] = I('note');
                    $pay['createtime'] = time();
                    M('payment')->add($payinfo);
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_order', 'order', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($order->getError());
            }
        } else {
            $series = M('series')->order('ser_sort desc,ser_id desc')->select();
            $live = M('live')->field('live_id,live_title')->order('live_id desc')->select();
            $video = M('video')->field('video_id,title')->order('video_id desc')->select();
            $this->assign('live',$live);
            $this->assign('video',$video);
            $this->assign('series',$series);
            $this->assign('info',null);
            $this->meta_title = '人工新增订单';
            $this->display('edit');
        }
    }

    /**
     * 编辑系列
     * @author 山大王
     */
    public function edit($id = 0){
        if(IS_POST){
            $order = D('order');
            $data = $order->create();
            if($data){
                $data['status'] = I('status');
                $data['lesson_type'] = I('lesson_type');
                $data['telphone'] = I('lesson_type');
                if($data['lesson_type']==1){

                    $data['lesson_id'] = I('series_id');
                    $data['live_type'] = 0;

                }elseif($data['lesson_type']==2){

                    $data['live_type'] = I('live_type');
                    if($data['live_type']==1){
                        $data['lesson_id'] = I('live_id');
                    }elseif($data['live_type']==2){
                        $data['lesson_id'] = I('video_id');
                    }

                }

                $payinfo['pay_id'] = I('pay_id');
                $payinfo['order_on'] = $data['order_on'];
                $payinfo['bankname'] = I('bankname');
                $payinfo['username'] = I('username');
                $payinfo['card_id'] = I('card_id');
                $payinfo['pay_amount'] = I('pay_amount');
                $payinfo['fee'] = I('pay_fee');
                $payinfo['description'] = I('note');
                $pay = M('payment')->save($payinfo);
                if($order->save($data) || $pay){

                    //记录行为
                    action_log('update_order', 'order', $data['ser_id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $this->error($order->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('order')->find($id);
            $payment = M('payment')->where(array('order_on'=>$info['order_on']))->find();
            if(false === $info){
                $this->error('获取配置信息错误');
            }
            $series = M('series')->order('ser_sort desc,ser_id desc')->select();
            $live = M('live')->field('live_id,live_title')->order('live_id desc')->select();
            $video = M('video')->field('video_id,title')->order('video_id desc')->select();
            $this->assign('live',$live);
            $this->assign('video',$video);
            $this->assign('series',$series);
            $this->assign('payinfo',$payment);
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
        if(M('order')->where($map)->delete()){
            //记录行为
            action_log('update_order', 'order', $id, UID);
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
