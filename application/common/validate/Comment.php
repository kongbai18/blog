<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 17:21
 */

namespace app\common\validate;


use think\Validate;

class Comment extends Validate
{
    protected $rule = [
        'article_id' => 'require|number',
        'comment_content' => 'require|max:150',
    ];

    protected $message  =   [
        'article_id.require' => '文章ID必须填写',
        'article_id.number'   => '文章ID只能是数字',
        'comment_content.require' => '评论内容不能为空',
        'comment_content.max' => '评论内容不能超过150字符',
    ];

}