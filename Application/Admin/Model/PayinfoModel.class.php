<?php
/**
 * @Author: 山大王
 * @Date:   2016-03-11 10:35:53
 * @Last Modified by:   山大王
 * @Last Modified time: 2016-03-17 11:48:12
 */
namespace Admin\Model;
use Think\Model;

class PayinfoModel extends Model {

    protected $tableName = 'order';

    protected $_validate = array(
        array('uname','require', '付款人用户名必须填写',1 ,'regex',3),
        array('pay_real','require', '付款金额必须填写',1 ,'regex',3),

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

