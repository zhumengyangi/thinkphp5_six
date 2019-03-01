<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;

class Comment extends Controller
{
 
   /**
   * @desc 用户评论接口
   * @param user_id  评论者用户id
   * @param content  评论内容
   * @param pid 回复评论的id
   */  
   public function comment(Request $request)
   {

        $return = [
            'code' => 2000,
            'msg'  => '评论成功',
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

        $userid = isset($params['user_id']) ? $params['user_id'] : 0;

        $content = isset($params['content']) ? $params['content'] : '';


        Db::execute('insert into ks_comment (user_id,content) values(?,?)', [$userid, $content]);

        return json($return);
   }

    /**
   * @desc 用户评论列表接口
   */  
   public function commentList(Request $request)
   {
       $return = [
            'code' => 2000,
            'msg'  => '成功',
            'data' => []
        ];

        $params = $request->param();
 
        $commentList = Db::query('select c.id,name, head_img, content, created_at, clicks from ks_comment c inner join ks_user u on c.user_id = u.id order by c.id desc');

        
        $return['data'] = $commentList;

        return json($return);
   }

    /**
   * @desc 用户评论删除接口
   * @param $id  评论id
   */  
   public function deleteComment(Request $request)
   {
        $return = [
            'code' => 2000,
            'msg'  => '成功',
            'data' => []
        ];

        $params = $request->param();

        if(!isset($params['id']) || empty($params['id'])){
            $return = [
                'code' => 4001,
                'msg'  => '评论id不能为空',
                'data' => []
            ];

            return json($return);
        }

        Db::execute('delete from ks_comment where id=?',[$params['id']]);


        return json($return);
   }

    /**
   * @desc 用户评论删除接口
   * @param $id  评论id
   */  
   public function clicks(Request $request)
   {
        $return = [
            'code' => 2000,
            'msg'  => '点赞成功',
            'data' => []
        ];

        $params = $request->param();

        if(!isset($params['id']) || empty($params['id'])){
            $return = [
                'code' => 4001,
                'msg'  => '评论id不能为空',
                'data' => []
            ];

            return json($return);
        }

        Db::execute('update ks_comment set clicks = clicks+1 where id = ?',[$params['id']]);


        return json($return);
   }
}
