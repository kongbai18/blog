<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/26 0026
 * Time: 14:25
 */

namespace app\common\model\v1;


class Comment extends Base
{
    public function getCommentList($articleId){
        $data = $this->field('a.comment_id,a.user_id,a.comment_content,a.create_time,b.user_name,b.user_photo_url')
            ->alias('a')
            ->join('user b','a.user_id = b.user_id','left')
            ->where('article_id','=',$articleId)
            ->order('comment_id asc')
            ->select();

        return $data;
    }
}