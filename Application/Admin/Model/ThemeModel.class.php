<?php
/**
 * @Author: 山大王
 * @Date:   2016-03-14 17:46:05
 * @Last Modified by:   山大王
 * @Last Modified time: 2016-03-25 15:29:10
 */

namespace Admin\Model;
use Think\Model;

class ThemeModel extends Model {

    protected $_validate = array(
        array('t_title','require', '必须填写主题标题',1 ,'regex',3),
        array('cl_id','require', '必须选择课程分类',1 ,'regex',3),

    );

}

