<?php
namespace app\common\model;

use think\Model;
use think\Db;

class Shop extends Model
{
    // 表名
    protected $table = 'shop';
    
    //主键字段名
    protected $pk = 'id';
      
    
    /**
     * 添加店铺
     */
    public function add_shop($data = array())
    {
        return Db::table($this->table)->insertGetId($data);
    }
    
    
    /**
     * 编辑店铺
     */
    public function edit_shop($data = array())
    {
        return Db::table($this->table)->update($data);
    }
    
    
    /**
     * 获取店铺信息
     */
    public function get_shop_info($where = array())
    {
        return Db::table($this->table)->where($where)->find();
    }
    
    
}