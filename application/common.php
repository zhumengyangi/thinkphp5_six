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
use think\Log;

/**
* @desc 验证用户的生成签名的函数
*/
function checkSign($params){

	//print_r($params);exit;
	//双方约定的秘钥
	$sercet = '123qwe';

	$return = [
            'code' => 2000,
            'msg'  => '成功',
            'data' => []
        ];

	if(!isset($params['sign']) || empty($params['sign'])){
		$return = [
            'code' => 4005,
            'msg'  => '签名不能为空',
            'data' => []
        ];

        return $return;
	}

   

	$post_sign = $params['sign'];

	Log::info('#接口传递的sign签名#:'.$post_sign);

	unset($params['sign']);

	$string = http_build_query($params);

	$create_sign = md5($string.$sercet);

	Log::info('#本地生成的sign签名#:'.$create_sign);

	//接口传递的签名和自己生成的签名进行比对
	if($post_sign !== $create_sign){
		$return = [
            'code' => 4006,
            'msg'  => '签名错误',
            'data' => []
        ];

        return $return;
	}

	return $return;
}
