<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model {
	protected $dbName = 'mysipo_bbs';
    protected $tablePrefix = 'mys_';
    protected $tableName = 'common_member';

    //获取用户ID
    public function getUserID($where){
    	$result = $this->table($tableName)->where($where)->field('uid')->find();
    	return $result;
    }

}

?>