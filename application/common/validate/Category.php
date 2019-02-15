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
        'cate_name' => 'require|max:20|unique:category',
        'cate_alias' => 'max:20',
        'parent_cate_id' => 'number',
        'order_id' => 'number|between:1,9999',
        'is_index' => 'number|between:0,1',
    ];

    protected $message  =   [
        'cate_name.require' => '分类名称必须填写',
        'cate_name.max'     => '分类名称最多不能超过20个字符',
        'cate_name.unique'  => '分类名称已存在',
        'cate_alias.max'    => '分类别名最多不能超过20个字符',
        'order_id.number'   => '排序只能是数字',
        'order_id.between'  => '排序只能在1-9999之间',
        'is_index'          => '是否展示数据错误',
    ];

}