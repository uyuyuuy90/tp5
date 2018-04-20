<?php
namespace app\common\model;

use think\Model;
use think\Db;

class User extends Model
{
    // 表名
    protected $table = 'user';
    
    //主键字段名
    protected $pk = 'id';
      
    
    /**
     * 添加用户
     */
    public function add_user($data = array())
    {
        return Db::table($this->table)->insertGetId($data);
    }

    
    /**
     * 编辑用户
     */
    public function edit_user($where = array(), $data = array())
    {
        return Db::table($this->table)->where($where)->update($data);
    }
    
    
    /**
     * 获取用户信息
     */
    public function get_user_info($where = array())
    {
        return Db::table($this->table)->where($where)->find();
    }
    
    
    /**
     * 获取用户列表
     */
    public function get_user_list($where = array())
    {
        return Db::table($this->table)->where($where)->select();
    }  
    
    
    
}