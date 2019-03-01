<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class Index extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = [
            'nav_num' => 3
        ];

        $nav = $this->HttpCurl('http://api.six.com/api/home/nav',true,$data);

        return $this->fetch();
    }

    /**
     * desc 商品详情页面
     */
    public function detail(Request $request)
    {
        $params = $request->param();

        $gid = isset($params['id']) ? $params['id'] : 0;

        //第一种方式curl请求api 接口
        // $data = [
        //     'gid' => $gid
        // ];
        
        // $detail = $this->HttpCurl('http://api.six.com/api/products/detail',true, $data);

        // $this->assign($detail['data']);

        $this->assign('gid',$gid);

        return $this->fetch();
    }

   
}
