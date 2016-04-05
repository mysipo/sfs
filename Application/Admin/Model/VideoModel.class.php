<?php
/**
 * @Author: 山大王
 * @Date:   2016-03-14 17:46:05
 * @Last Modified by:   山大王
 * @Last Modified time: 2016-03-28 20:34:00
 */

namespace Admin\Model;
use Think\Model;

class VideoModel extends Model {

    protected $_validate = array(
        array('title','require', '必须填写课程标题',1 ,'regex',3),
        array('cl_id','require', '必须选择课程分类',1 ,'regex',3),
        array('tch_id','require', '必须填写讲师用户名',1 ,'regex',3),
        array('price','require', '必须设置价格',1 ,'regex',3),

    );

     //字段映射
    protected $_map = array(
        'tch_name' =>'tch_id',
        'tutor_name' =>'tutor_id',
    );
}

