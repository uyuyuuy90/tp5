<?php
namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\model;

class User extends Controller
{
    
    /**
     * 注册
     */
    public function regist()
    {
        
        $request = Request::instance();
        
        if ($request->isPost()) {
            $username = $request->post('username');
            $password = $request->post('password');
            
            $random_str = get_random_str(2, 6);
            $secret_key = md5($random_str);
            $add_time = time();
            $ip = $request->ip();
            
            $data = [
                'username' => $username,
                'password' => md5(substr(md5($password), 0, 16).substr($secret_key, 0, 16)),
                'secret_key' => $secret_key,
                'add_time' => $add_time
            ];
            
            $User = new model\User();
            $add_result = $User->add_user($data);
            
            return $add_result;
            
        } else {
            
            $this->assign('name', '注册');
            return $this->fetch();
        }

    }
    

    /**
     * 登录
     */
    public function login()
    {
    	$username = 'xiangdong';
    	$password = '123456';

    	$where = array();
    	$where['username'] = $username;
    	
    	$User = new model\User();
    	$user_info = $User->get_user_info($where);
    	if ($user_info) {
    		if($user_info['password'] == md5(substr(md5($password), 0, 16).substr($user_info['secret_key'], 0, 16))) {

	    		$user_data = array();
	    		$user_data['user_id'] = $user_info['id'];
	    		$user_data['user_key'] = md5(substr($user_info['password'], 0, 16).$user_info['id'].substr($user_info['secret_key'], 0, 16));
				$user_data['status'] = $user_info['status'];
				$user_data['shop_id'] = $user_info['shop_id'];
				$user_data['username'] = $user_info['username'];
				$user_data['sex'] = $user_info['sex'];
				$user_data['last_login_time'] = date('Y-m-d H:i:s', $user_info['last_login_time']);

				return json_encode($user_data);
			}

    	}

    }



}
