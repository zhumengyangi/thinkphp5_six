<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;

class Api extends Controller
{
	public $sercet='1123123qweqweqweiqwie';

	//测试加入一条记录
	public function createSign(Request $request)
	{
		$params = $request->param();

		//把传递的参数拼接到一起
		$string = http_build_query($params);

		$sercet = $this->sercet;


		$sign = md5($string.$sercet);
		
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, 'http://api.six.com/api/api/checkSign');

		//$params['sign'] = $sign;

		$method = "post";

		if($method == "post"){
            //设置post方式请求数据
            curl_setopt($curl, CURLOPT_POST, true);

            //传递post请求的数据
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        }

        //执行curl操作
        $output = curl_exec($curl);

        //关闭释放curl资源
        curl_close($curl);

        var_dump($output);exit;
	}

	//验证签名
	public function checkSign(Request $request)
	{
		$params = $request->param();

		//var_dump($params);

		if(!isset($params['sign'])|| empty($params['sign'])){
			echo 'sign签名不能为空';exit;
		}

		$sign = $params['sign'];

		unset($params['sign']);

		$string = http_build_query($params);

		$sercet = $this->sercet;
		$new_sign = md5($string.$sercet);//重新生成签名

		if($new_sign !== $sign){
			echo '签名不合法或者签名错误';exit;
		}

		echo 'sign签名验证成功';
	}

    //请求登录的接口换去token值
	public function Login(Request $request)
	{
		$params = $request->param();//获取接口请求的所有参数

		//用户名
		$username = $params['username'];

		$password = $params['password'];


		$user = Db::query('select * from user where username = ? and password = ?',[$username, md5($password)]);

		if(!empty($username)){
			$userId = $user[0]['id'];

			//更新再本地生成token值
			Db::query('update user set token = replace(uuid(),"-","") ,expired_at = ? where id=?',[time()+7200,$userId]);

			$user = Db::query('select * from user where id=?',[$userId]);
		}

		$return = [
			'msg' => '登录成功',
			'data' => [
				'token' => $user[0]['token']
			]
		];

		//var_dump($return);exit;

		return json_encode($return);

	}

	//验证token的信息
	public function checkToken(Request $request)
	{
		$params = $request->param();

		if(!isset($params['token']) || empty($params['token'])){
			echo 'token不存在或者为空';
		}

		$token = $params['token'];

		$data = Db::query('select id,token, expired_at from user where token = ?',[$token]);

		if(empty($data)){
			echo 'token值不合法';exit;
		}

		if($data[0]['expired_at'] < time()){
			echo 'token已经过期';exit;
		}
		
		echo 'token验证成功';

	}

	public function Sms()
	{
		return $this->fetch('sms');
	}

	public function testSms(Request $request)
	{
		$params = $request->param();

		$phone = $params['phone'];

		$sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL

		$smsConf = [
			'key'   => 'f27aa760c504d9cdaa39b8f2e5edb19d', //您申请的APPKEY
    		'mobile'    => $phone, //接受短信的用户手机号码
   		    'tpl_id'    => '106440', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' =>'#code#='.rand(1,1000000) //您设置的模板变量，根据实际情况修改
		];

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $sendUrl);

		//设置文件流形式返回抓取的数据
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		//$params['sign'] = $sign;

		$method = "post";

		if($method == "post"){
            //设置post方式请求数据
            curl_setopt($curl, CURLOPT_POST, true);

            //传递post请求的数据
            curl_setopt($curl, CURLOPT_POSTFIELDS, $smsConf);
        }

        return $output =  curl_exec($curl);

        //关闭释放curl资源
       //curl_close($curl);
       

        //return json($output);
	}

	public function testApi()
	{

		//请求token验证接口
		$params = [
	        	'username' => 'liguanh',
	        	'password' => '123qwe'
	        ];

	    $output = $this->HttpCurl('http://api.six.com/api/api/login', true, $params);

	    $data = [

	    	'token' => $output['data']['token']

	    ];

	    $out = $this->HttpCurl('http://api.six.com/api/api/getStudentsList',true, $data);

	    var_dump($out);exit;


	}

	//分装httpcurl函数
	//$url curl请求的地址
	//$isPost 是否是post的请求
	//$data  如果post请求要传递的参数信息
	public function HttpCurl($url, $isPost=false, $data)
	{

		$curl = curl_init();

		//设置要请求的地址
		curl_setopt($curl, CURLOPT_URL, $url);

		//设置文件流形式返回抓取的数据
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		if($isPost){
			//设置post方式请求数据
	        curl_setopt($curl, CURLOPT_POST, true);

	        //传递post请求的数据
	        
	        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		

		$output = curl_exec($curl);

		return json_decode($output,true);
	}

	public function testPost()
	{
		$post = $_POST;

		return json($post);
	}


	//获取学生列表的接口

	public function getStudentsList(Request $request)
	{
		$return = [
			'code' => 200,
			'msg'  => '成功'
		];
		//验证token值
		$params = $request->param(); //接受所有的参数

		if(!isset($params['token']) || empty($params['token'])){

			$return = [
				'code' => 500,
				'msg'  => 'token不存在或者为空'
			];
			return json($return);
		}

		$token = $params['token'];

		$data = Db::query('select id,token, expired_at from user where token = ?',[$token]);

		if(empty($data)){
			$return = [
				'code' => 500,
				'msg'  => 'token值不合法'
			];
			return json($return);
		}

		if($data[0]['expired_at'] < time()){
			$return = [
				'code' => 500,
				'msg'  => 'token值已过期'
			];
			return json($return);
		}

		//获取学生列表并返回

		$students = Db::query('select * from students');

		$return['data'] = $students;

		return json($return);
	}

	
}