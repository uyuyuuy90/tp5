<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


function get_random_str($model = 0, $length = 4)
{
	$str_arr = [
		'0123456789',
		'abcdefghijklmnopqrstuvwxyz',
		'0123456789abcdefghijklmnopqrstuvwxyz',
	];
	$random_str = $str_arr[$model];

	$str = '';
	$random_str_length = strlen($random_str) - 1;
	for ($i=0; $i < $length; $i++) { 
		$str .= $random_str[mt_rand(0, $random_str_length)];
	}
	return $str;

}