<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Request;

class Goods extends Controller
{

    /**
     * @desc 首页商品展示接口
     * @param Request $request
     * @return \think\response\Json
     */
    public function home(Request $request)
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

        //要获取的商品的数量
        $nums = isset($params['nums']) ? $params['nums'] : 6;

        //获取首页商品列表
        $goods = Db::query('select id, goods_name, goods_img, price from goods where status = ? order by id desc limit ?',[2,$nums]);


        //获取分类列表

        $category = Db::query('select id, cate_name from goods_category');

        $data = [
            'goods' => $goods,
            'category' => $category
        ];

        $return['data'] = $data;
        return json($return);
    }

    /**
     * @desc 商品列表接口
     * @param Request $request
     * @return \think\response\Json
     */
    public function getList(Request $request)
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

        if(!isset($params['page']) || empty($params['page'])){
            $return = [
                'code' => 4002,
                'msg'  => '页码数不能为空',
                'data' => []
            ];

            return json($return);
        }

         //当前页
        $page = isset($params['page']) ? $params['page'] : 1;
        //每页显示条数
        $size = isset($params['size']) ? $params['size'] : 5;

        //偏移量
        $offset = ($page-1) * $size;

        //商品分类id
        $cid = isset($params['c_id']) ? $params['c_id'] : "";

        if(empty($cid)){
            $goods = Db::query('select id, goods_name, goods_img, content, price from goods order by id desc limit ?,?',[$offset, $size]);
        }else{
            $goods = Db::query('select id, goods_name, goods_img, content, price from goods where cate_id = ? order by id desc limit?,?',[$cid, $offset, $size]);
        }

        $return['data'] = $goods;

        return json($return);
    }

     /**
     * @desc 商品详情接口
     * @param Request $request
     * @return \think\response\Json
     */
    public function detail(Request $request)
    {
        $return = [
            'code' => 2000,
            'msg'  => '成功',
            'data' => []
        ];

        $params = $request->param();



        if(!isset($params['g_id']) || empty($params['g_id'])){
            $return = [
            'code' => 4003,
            'msg'  => '产品id不能为空',
            'data' => []
            ];

            return json($return);
        }

        $gid = $params['g_id'];

        $goodInfo = Db::query('select id, goods_name, goods_img, content,price,goods_num from goods where id =:id limit 1',['id'=>$gid]);

        $return['data'] = isset($goodInfo[0]) ? $goodInfo[0] : [];

        return json($return);
    }

     /**
     * @desc 创建订单接口
     * @param Request $request
     * @return \think\response\Json
     */
    public function createOrder(Request $request)
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

        $goodsId = isset($params['goods_id']) ? $params['goods_id'] : 0;
        $bookUser = isset($params['book_user']) ? $params['book_user'] : '';
        $bookPhone = isset($params['book_phone']) ? $params['book_phone'] : '';
        $goodsNum = isset($params['goods_num']) ? $params['goods_num'] : 0;

        $goodInfo = Db::query('select goods_num from goods where id = ?',[$goodsId]);


        $kucun = isset($goodInfo[0]) ? $goodInfo[0]['goods_num'] : 0;

        //判断库存
        if($kucun < $goodsNum){
            $return = [
                'code' => 4004,
                'msg'  => '库存不够啦，小二正在进货',
                'data' => []
            ];
            return json($return);
        }

        //开始事务
        Db::startTrans();
        try{

            //生成商品订单
            Db::execute("insert into `order` (goods_id,book_user, book_phone, goods_num) values(?,?,?,?)",[$goodsId,$bookUser,$bookPhone,$goodsNum]);

            //减库存
            Db::execute("update goods set goods_num = goods_num - ? where id=?",[$goodsNum,$goodsId]);

            //事务提交
            Db::commit();  
        }catch(\Exception $e){

            Db::rollback();

            $return = [
                'code' => $e->getcode(),
                'msg'  => $e->getmessage(),
            ];

            return json($return);
        }

        return json($return);
    }
}
