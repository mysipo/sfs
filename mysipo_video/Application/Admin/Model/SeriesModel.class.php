<?php
/**
 * @Author: 山大王
 * @Date:   2016-03-14 17:46:05
 * @Last Modified by:   山大王
 * @Last Modified time: 2016-03-14 17:51:39
 */

namespace Admin\Model;
use Think\Model;

class SeriesModel extends Model {

    protected $_validate = array(
        array('ser_title','require', '必须填写系列标题',1 ,'regex',3),
        array('cl_id','require', '必须选择课程分类',1 ,'regex',3),
        array('price','require', '必须设置价格',1 ,'regex',3),

    );

}

