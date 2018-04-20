<?php
namespace app\admin\controller;

use app\admin\controller\Common;
use app\common\model;
use think\Session;

class Goods extends Common
{
    
    /**
     * 添加商品
     */
    public function add_goods()
    {
        $goods_sn = trim($this->request->post('goods_sn'));
        $goods_name = trim($this->request->post('goods_name'));
        $goods_tag = intval($this->request->post('goods_tag'));
        $goods_price = $this->request->post('goods_price');
        $goods_description = trim($this->request->post('goods_description'));
        $shop_id = Session::get('user_info')['shop_id'];
        $status = 0;
        $add_time = time();
        $data = [
            'goods_sn' => $goods_sn,
            'goods_name' => $goods_name,
            'goods_tag' => $goods_tag,
            'goods_description' => $goods_description,
            'goods_price' => $goods_price,
            'shop_id' => $shop_id,
            'status' => $status,
            'add_time' => $add_time
        ];
        $goods_model = new model\Goods;
        $add_result = $goods_model->add_goods($data);
        
        print_r($add_result);
        exit;
        
    }
    
    
    
    /**
     * 编辑商品
     */
    public function edit_goods()
    {
        $goods_id = intval($this->request->post('goods_id'));
        $goods_sn = trim($this->request->post('goods_sn'));
        $goods_name = trim($this->request->post('goods_name'));
        $goods_tag = intval($this->request->post('goods_tag'));
        $goods_price = $this->request->post('goods_price');
        $goods_description = trim($this->request->post('goods_description'));
        $shop_id = Session::get('user_info')['shop_id'];
        
        $where = [
            'id' => $goods_id,
            'shop_id' => $shop_id
        ];
        $data = [
            'goods_sn' => $goods_sn,
            'goods_name' => $goods_name,
            'goods_tag' => $goods_tag,
            'goods_description' => $goods_description,
            'goods_price' => $goods_price,
        ];
        $goods_model = new model\Goods;
        $edit_result = $goods_model->edit_goods($where, $data);
        
        print_r($edit_result);
        exit;
    }
    
    
    
    /**
     * 获取商品信息
     */
    public function get_goods_info()
    {
        $goods_id = $this->request->get('goods_id');
        $shop_id = Session::get('user_info')['shop_id'];
        $where = [
            'id' => $goods_id,
            'shop_id' => $shop_id
        ];
        $goods_model = new model\Goods;
        $goods_info = $goods_model->get_goods_info($where);
        
        return $goods_info;
        
    }
    

    /**
     * 获取商品列表
     */
    public function get_goods_list()
    {
        $goods_name = trim($this->request->post('goods_name'));
    	$city = trim($this->request->post('city'));
    	$tag_id = intval($this->request->post('tag_id'));
    	$price = trim($this->request->post('price'));
    	$shop_id = Session::get('user_info')['shop_id'];
    	
    	$where = array();
    	$where['shop_id'] = $shop_id;
    	if ($goods_name != '') {
    	    $where['goods_name'] = ['REGEXP', $goods_name];
    	}
    	if ($city != '') {
    	    $where['city'] = $city;
    	}
    	if ($tag_id > 0) {
    	    $where['tag_id'] = $tag_id;
    	}    	
    	if ($price != '' && $price != '-') {
    	    $price_array = explode('-', $price);
    	    $where['goods_price'] = ['>', $price_array[0]];
    	    if ($price_array[1]) {
    	        $where['goods_price'] = ['<', $price_array[1]];
    	    }
    	} 	
    	
    	$goods_model = new model\Goods;
    	$goods_list = $goods_model->get_goods_list($where);
    	
    	return $goods_list;

    }
    

}
