<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Log;

class Home extends Controller
{
    /**
     * 显示首页资源信息
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        $return = [
            'code' => 2000,
            'msg'  => '获取成功',
            'data' => []
        ];

        //链接redis
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        $key = "admin_home_data";

        $homeData = $redis->get($key);

        //如果缓存的数据为空
        if(empty($homeData)){
            //订单总条数
            $order = Db::query('select count(id) nums from `order`');

            $order_num = isset($order[0]) ? $order[0]['nums'] : 0;

            
            $order1 = Db::query('select sum(goods.price*`order`.goods_num) as amount from goods inner join `order` on goods.id=`order`.goods_id');

            $amount = isset($order1[0]) ? $order1[0]['amount'] : 0;

            $order2 = Db::query('select avg(goods.price*`order`.goods_num) as avg_amount from goods inner join `order` on goods.id=`order`.goods_id');

            $avg_amount = isset($order2[0]) ? $order2[0]['avg_amount'] : 0;


            $new_order = Db::query('select id, book_user, book_phone, status, created_at from `order` order by id desc limit 5');


            $data = [
                'order_num' => $order_num, //订单数
                'amount'    => $amount,  //销售额
                'avg_amount' => round($avg_amount,2), //平均值
                'new_order' => $new_order
                ];

            Log::info('读取数据库中的数据'.json_encode($data));

            $redis->setex($key, 3600, json_encode($data));

        }else{
            Log::info('读取redis中的数据'.$homeData);
            $data = json_decode($homeData, true);
        }


        //print_r($data);exit;
        

        $return['data'] = $data;
    

        return json($return);
    }
}
