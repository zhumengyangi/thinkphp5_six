<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Request;
//use think\Log;
use think\Log;

class Article extends Controller
{

    /**
     * @desc  获取文章列表的接口
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

        //Log::recode(json_encode($params));exit;

        //验证接口安全sign签名
        $result = checkSign($params);

        if($result['code'] != 2000){
            return json($result);
        }

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


        //获取文章的总条数
        $count = Db::query('select count(*) as totals from article where status = ?',[2]);
        $totals = $count[0]['totals'];

        //文章总页数
        $totalPage = ceil($totals/$size);

        //偏移量
        $offset = ($page-1) * $size;

        //select article.id, title, image_url, content from article inner join article_extends on article.id = article_extends.a_id where status = 2 order by id desc limit 0, 2;
        $article = Db::query('select article.id, title, image_url, content from article inner join article_extends on article.id = article_extends.a_id where status = ? order by id desc limit ?, ?;',[2, $offset, $size]);

        //处理文章内容
        foreach ($article as $key => $value){
            $article[$key]['content'] = mb_substr($value['content'],0, 25);
        }

        //组装接口的数据
        $data = [
            'total_page' => $totalPage,
            'article'    => $article
        ];

        $return['data'] = $data;

        return json($return);
    }
}
