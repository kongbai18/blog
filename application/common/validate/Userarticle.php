<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 17:21
 */

namespace app\common\validate;


use think\Validate;

class Userarticle extends Validate
{
    protected $rule = [
        'article_id' => 'require|number',
    ];

    protected $message  =   [
        'article_id.require' => '文章ID必须填写',
        'article_id.number'   => '文章ID只能是数字',
    ];

}