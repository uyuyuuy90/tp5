<?php
namespace app\admin\controller;

use app\admin\controller\Common;
use app\common\model;
use think\Session;

class Shop extends Common
{
    
    /**
     * 编辑店铺信息
     */
    public function edit_shop()
    {
        $shop_name = intval($this->request->post('shop_name'));
        $shop_description = trim($this->request->post('shop_description'));
        $wechat = trim($this->request->post('wechat'));
        $mobile = intval($this->request->post('mobile'));
        $city = $this->request->post('city');
        
        $shop_id = Session::get('user_info')['shop_id'];
        
        $where = [
            'id' => $shop_id
        ];
        $data = [
            'shop_name' => $shop_name,
            'shop_description' => $shop_description,
            'wechat' => $wechat,
            'mobile' => $mobile,
            'city' => $city,
        ];
        $shop_model = new model\Shop;
        $edit_result = $shop_model->edit_shop($where, $data);
        
        print_r($edit_result);
        exit;
    }
    
    
    
    /**
     * 获取店铺信息
     */
    public function get_shop_info()
    {
        $shop_id = Session::get('user_info')['shop_id'];
        $where = [
            'id' => $shop_id
        ];
        $shop_model = new model\Shop;
        $shop_info = $shop_model->get_shop_info($where);
        
        return $shop_info;
        
    }
    

}
