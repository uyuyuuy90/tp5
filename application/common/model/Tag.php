<?php
namespace app\common\model;

use think\Model;
use think\Db;

class Tag extends Model
{
    // 表名
    protected $table = 'tag';
    
    //主键字段名
    protected $pk = 'id';
      
    
    /**
     * 添加标签
     */
    public function add_tag($data = array())
    {
        return Db::table($this->table)->insertGetId($data);
    }
    
    
    /**
     * 编辑标签
     */
    public function edit_tag($data = array())
    {
        return Db::table($this->table)->update($data);
    }
    
    /**
     * 删除标签
     */
    public function del_tag($where = array())
    {
        return Db::table($this->table)->where($where)->delete();
    }
    
    /**
     * 获取标签信息
     */
    public function get_tag_info($where = array())
    {
        return Db::table($this->table)->where($where)->find();
    }
    
    
    /**
     * 获取标签列表
     */
    public function get_tag_list($where = array())
    {
        return Db::table($this->table)->where($where)->select();
    }
    
    
}