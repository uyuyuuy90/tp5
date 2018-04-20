<?php
namespace app\common\model;

use think\Model;
use think\Db;

class Goods extends Model
{
    // 表名
    protected $table = 'goods';
    
    //主键字段名
    protected $pk = 'id';
      
    
    /**
     * 添加商品
     */
    public function add_goods($data = array())
    {
        return Db::table($this->table)->insertGetId($data);
    }
    
    
    /**
     * 编辑商品
     */
    public function edit_goods($where = array(), $data = array())
    {
        return Db::table($this->table)->where($where)->update($data);
    }
    
    
    /**
     * 获取商品信息
     */
    public function get_goods_info($where = array())
    {
        return Db::table($this->table)->where($where)->find();
    }
    
    
    /**
     * 获取商品列表
     */
    public function get_goods_list($where = array())
    {
        if (!$where) {
            $where = '1 = 1';
        }
        return Db::table($this->table)->where($where)->select();
    }
    
    
    
}