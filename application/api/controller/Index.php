<?php
namespace app\api\controller;

use think\Db;
class Index
{
    public function index()
    {

    	print_r(Db::table('user')->select());
    	exit;
    	$username = 'xiangdong';
    	$password = '123456';
    	$secret_key = md5(get_random_str(2, 6)); //32位随机字符串
    	$add_time = time();

    	print_r(get_random_str(2, 6));

    	$data = array(
    		'username' => $username,
    		'password' => md5(substr(md5($password), 0, 16).substr($secret_key, 0, 16)),
    		'secret_key' => $secret_key,
    		'add_time' => $add_time
    	);

    	print_r(Db::table('user')->insert($data));
    	exit;

    }

    public function login()
    {
    	$username = 'xiangdong';
    	$password = '123456';

    	$user_info = Db::table('user')->field('id,username,password,status,shop_id,last_login_time,sex,secret_key')->where('username', $username)->find();
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

				return $user_data;
			}

    	}

    }

    public function check_user()
    {
    	$user_id = 3;
    	$user_key = 'bea98c3c7be94c0e5674deb8888b145c';

    	$user_info = Db::table('user')->field('id,username,password,status,shop_id,last_login_time,sex,secret_key')->where('id', $user_id)->find();
    	if ($user_info) {
    		if ($user_key == md5(substr($user_info['password'], 0, 16).$user_info['id'].substr($user_info['secret_key'], 0, 16))) {
    			return 1;
    		} else {
    			return 0;
    		}

    	}


    }


}
