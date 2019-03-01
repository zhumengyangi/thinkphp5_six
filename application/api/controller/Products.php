<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;

class Products extends Controller
{
    /**
     * 商品详情的接口
     * @param $gid int 商品id
     * @return \think\Response
     */
    public function detail(Request $request)
    {
        //接受请求的参数
        $params = $request->param();

        //接口返回格式
        $return = [
            'code' => 2000,
            'msg'  => '成功',
            'data' => []
        ];

        //判断参数是否传递
        if(!isset($params['gid']) || empty($params['gid'])){
            $return = [
                'code' => 4001,
                'msg'  => '参数不全'
            ];

            return json($return);
        }

        //gid接受参数
        $gid = $params['gid'];

        //获取商品的详情
        $goodsInfo = Db::query('select * from bp_goods where id=?',[$gid]);

        //获取商品相册
        $goodsImg = Db::query('select image_url, source_image_url from bp_goods_img where goods_id = ?',[$gid]);

        $return['data']['goods'] = $goodsInfo[0];

        $return['data']['goods_image'] = $goodsImg;

        return json($return);
    }

    /**
     * Desc   商品评论接口
     * @param goods_id int 
     * @param c_type int
     * @param content string
     * @return json 
     */
    public function comment(Request $request)
    {
        //接受请求的参数
        $params = $request->param();

        //接口返回格式
        $return = [
            'code' => 2000,
            'msg'  => '成功',
            'data' => []
        ];

        //验证sign签名是否合法
        $result = $this->createSign($params);
        if($result['code'] != 2000){
            return json($result);
        }

        //判断参数是否传递
        if(!isset($params['goods_id']) || empty($params['goods_id'])){
            $return = [
                'code' => 4001,
                'msg'  => '参数不全'
            ];

            return json($return);
        }

        if(!isset($params['c_type']) || empty($params['c_type'])){
            $return = [
                'code' => 4001,
                'msg'  => '参数不全'
            ];

            return json($return);
        }

        if(!isset($params['content']) || empty($params['content'])){
            $return = [
                'code' => 4001,
                'msg'  => '参数不全'
            ];

            return json($return);
        }

        try{
            //插入评论的sql
            Db::query('insert into bp_goods_comment (goods_id,comment_type, content) values(?,?,?)',[ $params['goods_id'], $params['c_type'], $params['content'] ]);

        }catch(\Exception $e){

            $return = [
                'code' => $e->getCode(),
                'msg'  => $e->getMessage()
            ];
        }
        


        return json($return);
    }

    //评论列表接口
    public function comment_list(Request $request)
    {
        //接受请求的参数
        $params = $request->param();

        //接口返回格式
        $return = [
            'code' => 2000,
            'msg'  => '成功',
            'data' => []
        ];

        $goods_id = $params['g_id'];

        $comment = Db::query('select * from bp_goods_comment where goods_id = ?',[$goods_id]);


        $return['data'] = $comment;


        return json($return);

    }

    public function delComment(Request $request)
    {
        //接受请求的参数
        $params = $request->param();

        //接口返回格式
        $return = [
            'code' => 2000,
            'msg'  => '成功',
            'data' => []
        ];

        $id = $params['id'];

        Db::query('delete from bp_goods_comment where id = ?',[$id]);

        return json($return);
    }

    /**
     * 添加商品购物车的api及接口
     * @param $token 
     * @param $goods_id
     * @param $price
     * @param $goods_num  default 1
     * @param json
     */
    public function addCart(Request $request)
    {
        //接受请求的参数
        $params = $request->param();

        //接口返回格式
        $return = [
            'code' => 2000,
            'msg'  => '成功',
            'data' => []
        ];

        //1、校验token值是否合法
        $check = $this->checkCommonToken($params);

        if($check['code'] != 2000){
            return json($check);
        }

        //2、通过token值拿到user_id
        $user = Db::query('select id from bp_user where access_token = ?',[$params['token']]);

        //3、使用user_id和goods_id去查询购物车表是否记录
        $cart = Db::query('select * from bp_cart where user_id = ? and goods_id = ?',[ $user[0]['id'], $params['goods_id'] ]);

        try{

            if(empty($cart)){//记录不存在
            $goods_num = isset($params['goods_num']) ? $params['goods_num'] : 1; //商品数据量

            Db::query("insert into bp_cart (user_id,goods_id, goods_num,unit_price,total_price) values(?,?,?,?,?)",[ $user[0]['id'], $params['goods_id'], $goods_num, $params['price'], $params['price']*$goods_num ]);
        
            }else{//记录存在的情况下更新购物车

                $goods_num = isset($params['goods_num']) ? $cart[0]['goods_num'] + $params['goods_num'] : $cart[0]['goods_num'] + 1; //商品数据量

                Db::query('update bp_cart set goods_num = ?, unit_price=?, total_price =? where goods_id =? and user_id = ?',[ $goods_num, $params['price'], $params['price']*$goods_num, $params['goods_id'], $user[0]['id'] ]);
                
            }

        }catch(\Exception $e){

            $return = [
                'code' => $e->getCode(),
                'msg'  => $e->getMessage()
            ];

            return json($return);
        }

        return json($return);

    }

    /**
     * 用户购物车列表的接口
     * @param $token
     * @return json
     */
    public function cartList(Request $request)
    {

         //接受请求的参数
        $params = $request->param();

        //接口返回格式
        $return = [
            'code' => 2000,
            'msg'  => '成功',
            'data' => []
        ];

        //1、校验token值是否合法
        $check = $this->checkCommonToken($params);

        if($check['code'] != 2000){
            return json($check);
        }

        //2、通过token值拿到user_id
        $user = Db::query('select id from bp_user where access_token = ?',[$params['token']]);

        //连表查询用户购物车的信息 bp_goods, bp_cart
        $cartList = Db::query('select goods_image,goods_name,type, goods_num,unit_price,total_price from bp_cart as c left join bp_goods as g on c.goods_id = g.id where user_id =?', [ $user[0]['id'] ]);

        //获取统计信息
        $cartInfo = Db::query('select sum(total_price) as total_amount from bp_cart as c left join bp_goods as g on c.goods_id = g.id where user_id =?', [ $user[0]['id'] ]);

        $return['data'] = [
            'cart_list' => $cartList,
            'total_amount' => $cartInfo[0]['total_amount'],
            'fee'       => 5,
            'total_order' => $cartInfo[0]['total_amount'] + 5
        ];

        return json($return);
    }

    
}
