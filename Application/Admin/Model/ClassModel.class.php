<?php
/**
 * @Author: 山大王
 * @Date:   2016-03-10 16:22:05
 * @Last Modified by:   Administrator
 * @Last Modified time: 2016-03-11 15:16:22
 */
namespace Admin\Model;
use Think\Model;

/**
 * 导航模型
 * @author 山大王
 */

class ClassModel extends Model {
    protected $_validate = array(
        array('cl_title', 'require', '标题不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(

        array('cl_time', NOW_TIME, self::MODEL_INSERT),
    );

}
