<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;

class Common extends Controller
{
    protected $request = NULL;
    
    public function __construct()
    {
        parent::__construct();
        
        if ($this->request->action() != 'login') {
            $user_info = Session::get('user_info');
//             print_r($user_info);
            if (!$user_info) {
                exit('未登录');
            }
        }

    }

}
