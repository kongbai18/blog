<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/26 0026
 * Time: 14:26
 */

namespace app\index\model;

use app\common\model\v1\Comment as CommentModel;

class Comment extends CommentModel
{
    public function add($data){
        $this->allowField(true)->save($data);

        return [
            'comment_id' => $this->comment_id,
            'create_time' => time(),
        ];
    }
}