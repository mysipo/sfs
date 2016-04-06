<?php
/**
 * @Author: 山大王
 * @Date:   2016-03-11 10:35:53
 * @Last Modified by:   山大王
 * @Last Modified time: 2016-03-29 14:49:57
 */
namespace Admin\Model;
use Think\Model;

class PlayliveModel extends Model {

    protected $tableName = 'live';

    protected $_validate = array(
        array('live_title','require', '必须填写课程标题',1 ,'regex',3),
        array('live_start_time','require', '必须设置开始时间',1 ,'regex',3),
        array('live_stop_time','require', '必须设置结束时间',1 ,'regex',3),
        array('tch_id','require', '必须设置讲师用户名',1 ,'regex',3),
        array('live_img','require', '必须设置标志图',1 ,'regex',3),

    );

    //字段映射
    protected $_map = array(
        'tch_name' =>'tch_id',
        'tutor_name' =>'tutor_id',
    );


    /**
     * 返回直播课程列表
     * @author 山大王
     */
    static public function lists($where,$field="*"){
        $prefix = C('DB_PREFIX');
        $lists = M('live')
            ->table($prefix.'live a')
            ->join ($prefix."ucenter_members u ")
            ->join ($prefix."ucenter_members s ")
            ->where($where)
            ->field($field)
            ->select();
        return $lists;
    }

}

