<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 17:21
 */

namespace app\common\validate;


use think\Validate;

class Label extends Validate
{
    protected $rule = [
        'label_name' => 'require|max:20|unique:label',
        'label_alias' => 'max:20',
        'order_id' => 'number|between:1,9999',
        'is_index' => 'number|between:0,1',
    ];

    protected $message  =   [
        'label_name.require' => '标签名称必须填写',
        'label_name.max'     => '标签名称最多不能超过20个字符',
        'label_name.unique'  => '标签名称已存在',
        'label_alias.max'    => '标签别名最多不能超过20个字符',
        'order_id.number'    => '排序只能是数字',
        'order_id.between'   => '排序只能在1-9999之间',
        'is_index'           => '是否展示数据错误',
    ];

}