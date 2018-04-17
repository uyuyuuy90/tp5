<?php
namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\model;


class Common extends Controller
{
    protected $request = NULL;
    public function __construct()
    {
        parent::__construct();
        $this->request = Request::instance();
        $user_id = intval($this->request->post('user_id'));
        
        if ($user_id) {
            $user_key = trim($this->request->post('user_key'));
            $user_model = new model\User;
            $where = array('id' => $user_id);
            $user_info = $user_model->get_user_info($where);
            if ($user_info) {
                $real_user_key = md5(substr($user_info['password'], 0, 16).$user_info['id'].substr($user_info['secret_key'], 0, 16));
                if ($user_key !== $real_user_key) {
                    exit('user_key is wrong!');
                }
            } else {
                exit('user_id 不存在');
            }  
        }

        
        
    }


}
