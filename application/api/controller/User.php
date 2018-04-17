<?php
namespace app\api\controller;

use app\api\controller\Common;
use app\api\model;

class User extends Common
{
    
    /**
     * 用户注册
     */
    public function regist()
    {
        if ($this->request->isPost()) {
            $username = $this->request->post('username');
            $password = $this->request->post('password');
            
            $random_str = get_random_str(2, 6);
            $secret_key = md5($random_str);
            $add_time = time();
            $password_encrypt = md5(substr(md5($password), 0, 16).substr($secret_key, 0, 16));
//             $ip = $this->request->ip();
            $sex = intval($this->request->post('sex'));
            
            $data = [
                'username' => $username,
                'password' => $password_encrypt,
                'secret_key' => $secret_key,
                'sex' => $sex,
                'add_time' => $add_time
            ];
            
            $user_model = new model\User();
            $add_result = $user_model->add_user($data);
            
            return $add_result;
            
        } else {
            
            $this->assign('name', '注册');
            return $this->fetch();
        }

    }
    

    /**
     * 用户登录
     */
    public function login()
    {
    	$username = $this->request->post('username');
    	$password = $this->request->post('password');

    	$user_model = new model\User();
    	$where = ['username' => $username];
    	$user_info = $user_model->get_user_info($where);
    	if ($user_info) {
    	    $password_encrypt = md5(substr(md5($password), 0, 16).substr($user_info['secret_key'], 0, 16));
    		if($user_info['password'] === $password_encrypt) {

	    		$user_data = array();
	    		$user_data['user_id'] = $user_info['id'];
	    		$user_data['user_key'] = md5(substr($user_info['password'], 0, 16).$user_info['id'].substr($user_info['secret_key'], 0, 16));
				$user_data['status'] = $user_info['status'];
				$user_data['shop_id'] = $user_info['shop_id'];
				$user_data['username'] = $user_info['username'];
				$user_data['sex'] = $user_info['sex'];
				$user_data['last_login_time'] = date('Y-m-d H:i:s', $user_info['last_login_time']);

				return $user_data;
				
			} else {
			    return array('message'=>'密码错误');
			}

    	} else {
    	    return array('message'=>'用户不存在');
    	}

    }
    
    
    /**
     * 修改用户密码
     */
    public function update_password()
    {
        $user_id = $this->request->post('user_id');
        $current_password = $this->request->post('current_password');
        $new_password = $this->request->post('new_password');
        
        $user_model = new model\User;
        $where = array('id' => $user_id);
        $user_info = $user_model->get_user_info($where);
        if ($user_info) {
            $current_password_encrypt = md5(substr(md5($current_password), 0, 16).substr($user_info['secret_key'], 0, 16));
            if ($current_password_encrypt === $user_info['password']) {
                $new_password_encrypt = md5(substr(md5($new_password), 0, 16).substr($user_info['secret_key'], 0, 16));
                $data = [
                    'id' => $user_id,
                    'password' => $new_password_encrypt
                ];
                $update_result = $user_model->edit_user($data);
                if ($update_result) {
                    return array('message'=>'密码修改成功');
                } else {
                    return array('message'=>'密码修改失败');
                }
            } else {
                return array('message'=>'密码不正确');
            }
        } else {
            return array('message'=>'用户不存在');
        }
        
    }
    
    
    



}
