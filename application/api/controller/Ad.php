<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Request;

class Ad extends Controller
{

    const
        STATUS_FAIL = 1, //非正常
        STATUS_NORMAL = 2, //正常
        END = TRUE;

    /**
     * @desc 首页广告接口
     * @param Request $request
     * @return \think\response\Json
     */
    public function home(Request  $request)
    {
        $return = [
            'code' => 2000,
            'msg'  => '成功',
            'data' => []
        ];

        $params = $request->param();

        //判断参数不能为空
        if(empty($params)){
            $return = [
                'code' => 4001,
                'msg'  => '参数不能为空',
                'data' => []
            ];

            return json($return);
        }

        //banner图的个数
        $num = isset($params['banner_num']) ? $params['banner_num'] : 2;

        $data = [];
        //获取首页顶部广告信息
        $homeTop = Db::query('select id, title,image_url from ad where p_id = ? and status = ? order by id desc limit ?', [1,self::STATUS_NORMAL, 1]);

        //获取轮播图
        $banner = Db::query('select id, title,image_url from ad where p_id = ? and status = ? order by id desc limit ?', [2,self::STATUS_NORMAL, $num]);

        //组装广告的数据
        $data = [
            'home_top' => $homeTop,
            'banner'   => $banner
        ];

        $return['data'] = $data;

        return json($return);
    }
}
