<?php

namespace Admin\Controller;

use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 批阅管理
 */
class MarkingController extends AdminController {

    /**
     * 未批阅列表
     */
    public function index() {
        $Marking = M('Marking'); // 实例化User对象
        $count = $Marking->where('status=0')->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 25); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show(); // 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $data = $Marking->where('status=0')->order('marking_id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

        /* 绑定课程信息 */
        $list = array();
        $User = D('User');
        if (is_array($data)) {
            foreach ($data as $vo) {
                $vo['username'] = $User->getFieldByUid('2', 'username');
                $vo['seriesnmae'] = $this->showSerName($vo['series_id']);
                $vo['lesson'] = $this->getLessonName($vo['lesson_id']);
                $list[] = $vo;
            }
        }

        $this->assign('list', $list); // 赋值数据集
        $this->assign('page', $show); // 赋值分页输出
        $this->display();
    }

    /**
     * 获取课程信息
     * @param  int     $id    课程id
     * @return array          课程信息
     */
    public function getLessonName($id) {
        if (empty($id)) {
            return '未知课程';
        }

        /* 课程信息 */
        $lesson = M('Live');
        $map['live_id'] = $id;
        return $lesson->where($map)->field('live_id,live_title,live_start_time,live_stop_time')->find();
    }

    /**
     * 文件上传
     * @param  int     $id    课程id
     * @return array          课程信息
     */
    public function upload() {
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 3145728; // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
        $upload->rootPath = './Uploads/'; // 设置附件上传根目录
        $upload->savePath = ''; // 设置附件上传（子）目录
        // 上传文件 
        $info = $upload->upload();
        if (!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        } else {// 上传成功
            $this->success('上传成功！');
        }
    }

    /**
     * 获取系列名称
     * @param  integer $code 错误编码
     * @return string        错误信息
     */
    private function showSerName($code = 0) {
        switch ($code) {
            case 1: $item = '国内专利申请考试(初级)';
                break;
            case 2: $item = '国内专利申请实战(初级)';
                break;
            case 3: $item = '国内专利申请实战(中级)';
                break;
            case 4: $item = '国内专利申请技能职业培训(初级)';
                break;
            case 5: $item = '国内专利申请技能职业培训(初级)';
                break;
            case 6: $item = '国内专利申请技能职业培训(中级)';
                break;
            case 7: $item = '国内专利申请技能职业培训(高级)';
                break;
            case 8: $item = '2016专利代理人资格考试(专利法)';
                break;
            case 9: $item = '2016专利代理人资格考试(相关法)';
                break;
            case 10: $item = '2016专利代理人资格考试(事务标准)';
                break;
            case 11: $item = '2016专利代理人资格考试(保过班)';
                break;
            default: $item = '未知系列';
        }
        return $item;
    }

}
