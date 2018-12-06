<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 17:21
 */

namespace app\common\validate;


use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'cate_name' => 'require|max:30|unique:category',
        'cate_name' => 'max:30',
    ];
}