<?php
namespace app\api\model;

use think\Model;
use think\Db;

class GoodsPhotos extends Model
{
    // 表名
    protected $table = 'goods_photos';
    
    //主键字段名
    protected $pk = 'id';
      
    
    /**
     * 添加图片
     */
    public function add_photo($data = array())
    {
        return Db::table($this->table)->insertGetId($data);
    }
    
    
    /**
     * 获取图片列表
     */
    public function get_photo_list($where = array())
    {
        return Db::table($this->table)->where($where)->select();
    }
    
    
    /**
     * 删除图片
     */
    public function del_photo($where = array())
    {
        return Db::table($this->table)->delete($where);
    }
    
    
}