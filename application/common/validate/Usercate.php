<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 17:21
 */

namespace app\common\validate;


use think\Validate;

class Usercate extends Validate
{
    protected $rule = [
        'cate_id' => 'require|number',
    ];

    protected $message  =   [
        'cate_id.require' => '话题ID必须填写',
        'cate_id.number'   => '话题ID只能是数字',
    ];

}