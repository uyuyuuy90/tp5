<?php
namespace app\admin\controller;

use app\admin\controller\Common;
use app\common\model;
use think\Session;

class Tag extends Common
{
    
    /**
     * 添加标签
     */
    public function add_tag()
    {
        $tag_name = trim($this->request->post('tag_name'));
        $shop_id = Session::get('user_info')['shop_id'];
        $add_time = time();
        $data = [
            'tag_name' => $tag_name,
            'shop_id' => $shop_id,
            'add_time' => $add_time
        ];
        $tag_model = new model\Tag;
        $add_result = $tag_model->add_tag($data);
        
        print_r($add_result);
        exit;
        
    }
    
    
    
    /**
     * 编辑标签
     */
    public function edit_tag()
    {
        $tag_name = trim($this->request->post('tag_name'));
        $tag_id = intval($this->request->post('tag_id'));
        $shop_id = Session::get('user_info')['shop_id'];
        
        $where = [
            'id' => $tag_id,
            'shop_id' => $shop_id
        ];
        $data = [
            'tag_name' => $tag_name
        ];
        $tag_model = new model\Tag;
        $edit_result = $tag_model->edit_tag($where, $data);
        
        print_r($edit_result);
        exit;
    }
    
    /**
     * 编辑标签
     */
    public function del_tag()
    {
        $tag_id = intval($this->request->post('tag_id'));
        $shop_id = Session::get('user_info')['shop_id'];
    
        $where = [
            'id' => $tag_id,
            'shop_id' => $shop_id
        ];
        $tag_model = new model\Tag;
        $del_result = $tag_model->del_tag($where);
    
        print_r($del_result);
        exit;
    }
    
    /**
     * 获取标签信息
     */
    public function get_tag_info()
    {
        $tag_id = intval($this->request->get('tag_id'));
        $shop_id = Session::get('user_info')['shop_id'];
        $where = [
            'id' => $tag_id,
            'shop_id' => $shop_id
        ];
        $tag_model = new model\Tag;
        $tag_info = $tag_model->get_tag_info($where);
        
        return $tag_info;
        
    }
    

    /**
     * 获取标签列表
     */
    public function get_tag_list()
    {
        $tag_name = trim($this->request->post('tag_name'));
    	$shop_id = Session::get('user_info')['shop_id'];
    	
    	$where = array();
    	$where['shop_id'] = $shop_id;
    	if ($tag_name != '') {
    	    $where['tag_name'] = ['REGEXP', $tag_name];
    	}
    	
    	$tag_model = new model\Tag;
    	$tag_list = $tag_model->get_tag_list($where);
    	
    	return $tag_list;

    }
    

}
