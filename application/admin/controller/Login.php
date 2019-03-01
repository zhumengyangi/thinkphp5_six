<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Login extends Controller
{
    /**
     * 登录方法
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {

        $return = [
            'code' => 2000,
            'msg'  => '登录成功',
            'data' => []
        ];

        $params = $request->param();

        //用户名不能为空
        if(!isset($params['username']) || empty($params['username'])) {
             $return = [
            'code' => 4007,
            'msg'  => '用户名不能为空',
            'data' => []
           ];

           return json($return);
        }

        //密码不能为空
        if(!isset($params['password']) || empty($params['password'])) {
             $return = [
            'code' => 4008,
            'msg'  => '密码不能为空',
            'data' => []
           ];

           return json($return);
        }

        //根据用户名获取用户的记录
        $userInfo = Db::query('select * from admin_users where username = ? limit 1',[$params['username']]);

        //用户不存在
        if(empty($userInfo)){
            $return = [
            'code' => 4009,
            'msg'  => '用户不存在',
            'data' => []
            ];

           return json($return);
        }else{//用户名存在，比较密码正确性
            //传递过来的密码
            $postPwd = md5($params['password']);

            $dbPwd = isset($userInfo[0]) ? $userInfo[0]['password'] : '';

            if($postPwd != $dbPwd) {
                $return = [
                'code' => 4010,
                'msg'  => '密码错误',
                'data' => []
                ];

                return json($return);
            }
        }

        //校验成功，生成token
        $id = isset($userInfo[0]) ? $userInfo[0]['id'] : 0;
        Db::execute("update admin_users set token = replace(uuid(), '-',''), expired_at = ? where id = ? ",[time()+600, $id]);


        $userInfo = Db::query('select token from admin_users where id =?',[$id]);

        $return['data']['token'] = isset($userInfo[0]) ? $userInfo[0]['token'] : '';

        return json($return);
    }

    /**
     * @desc 用户退出登录
     */
    public function logout(Request $request)
    {
         $return = [
            'code' => 2000,
            'msg'  => '退出成功',
            'data' => []
        ];

        $params = $request->param();

        if(!isset($params['token']) || empty($params['token'])){
            $return = [
            'code' => 4011,
            'msg'  => 'token不能为空',
            'data' => []
           ];

           return json($return);
        }

        Db::execute('update admin_users set expired_at = ? where token = ?',[time()-10,$params['token']]);

        return json($return);
    }

    /**
     * @desc 验证token是否合法
     */
    public function checkToken(Request $request)
    {
        $return = [
            'code' => 2000,
            'msg'  => '验证成功',
            'data' => []
        ];

         $params = $request->param();

        if(!isset($params['token']) || empty($params['token'])){
            $return = [
            'code' => 4011,
            'msg'  => 'token不能为空',
            'data' => []
           ];

           return json($return);
        }

        $userInfo = Db::query('select token, expired_at from admin_users where token = ?',[$params['token']]);

        if(empty($userInfo)){
            $return = [
            'code' => 4012,
            'msg'  => 'token不存在',
            'data' => []
           ];

           return json($return);
        }else{
            $expired = isset($userInfo[0]) ? $userInfo[0]['expired_at'] : 0;

            if(time() > $expired) {
                 $return = [
                'code' => 4012,
                'msg'  => 'token已过期',
                'data' => []
                ];

                return json($return);
            }
        }

        return json($return);
    }
}
