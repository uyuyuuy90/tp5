<?php
namespace app\api\controller;

use app\api\controller\Common;
use app\common\model;

class Goods extends Common
{
    
    /**
     * 获取商品信息
     */
    public function get_goods_info()
    {
        $goods_id = $this->request->get('goods_id');
        
        $where = array('id' => $goods_id);
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
    	$shop_id = intval($this->request->post('shop_id'));
    	$city = trim($this->request->post('city'));
    	$tag_id = intval($this->request->post('tag_id'));
    	$price = trim($this->request->post('price'));
    	
    	$where = array();
    	if ($goods_name != '') {
    	    $where['goods_name'] = ['REGEXP', $goods_name];
    	}
    	if ($shop_id > 0) {
    	    $where['shop_id'] = $shop_id;
    	} 	
    	if ($city != '') {
    	    $where['city'] = $city;
    	}
    	if ($tag_id > 0) {
    	    $where['tag_id'] = $tag_id;
    	}    	
    	if ($price && $price != '' && $price != '-') {
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
