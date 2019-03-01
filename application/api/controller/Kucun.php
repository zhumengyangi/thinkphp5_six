<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;

class Kucun extends Controller
{
    /**
     * 获取库存资源列表
     *
     * @return \think\Response
     */
    public function getList()
    {
        $return = [
            'code' => 2000,
            'msg'  => '获取列表成功',
            'data' => []
        ];

        $KuList  = Db::query('select k.id, goods.goods_name, goods_category.cate_name, k.nums, k.in_date from kuncun k left join goods on k.goods_id = goods.id left join goods_category on k.cate_id = goods_category.id order by k.id desc');

        $return['data'] = $KuList;

        return json($return);
    }

    /**
     * 添加库存资源

     * @param cate_id 分类id
     * @param goods_id 商品id
     * @param nums 数量
     * @param note 备注
     * @return \think\Response
     */
    public function addData(Request $request)
    {
        $return = [
            'code' => 2000,
            'msg'  => '添加成功',
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
        $cateId = isset($params['cate_id']) ? $params['cate_id'] : 0;
        $nums = isset($params['nums']) ? $params['nums'] : 0; //数量
        $note = isset($params['note']) ? $params['note'] : ''; //备注
        $inDate = date('Y-m-d',time()); //日期


        //try catch 捕获异常
        try{

             Db::query('insert into kuncun (goods_id, cate_id, nums, in_date, note) values(?,?,?,?,?)',[$goodsId, $cateId, $nums, $inDate, $note]);

        }catch(\Exception $e){
            $return['code'] = $e->getCode();
            $return['msg'] = $e->getMessage();

            return json($return);
        }

        return json($return);

    }

    /**
     * 获取商品+分类的列表
     *
     * @return \think\Response
     */
    public function getGoodsAndCate()
    {
        $return = [
            'code' => 2000,
            'msg'  => '获取列表成功',
            'data' => []
        ];


        $cateList = Db::query('select id, cate_name from goods_category');//分类的列表

        $goodsList = Db::query('select id, goods_name from goods');//商品的列表


        $return['data'] = [
            'cate_list' => $cateList,
            'goods_list' => $goodsList
        ];


        return json($return);
    }

  
}
