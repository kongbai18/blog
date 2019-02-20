<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/20 0020
 * Time: 10:33
 */

namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'user_name' => 'require|max:20|unique:user',
        'user_password' => 'require|min:8|max:20',
        'user_phone' => 'require|checkPhone:thinkphp|unique:user',
        'user_email' => 'email',
    ];

    protected $message  =   [
        'user_name.require' => '用户名必须填写',
        'user_name.max'     => '用户名最多不能超过20个字符',
        'user_name.unique'  => '用户名已存在',
        'user_password.require'=> '密码必须填写',
        'user_password.min'    => '密码最少不能低于8个字符',
        'user_password.max'    => '密码最多不能超过20个字符',
        'user_phone.require' => '手机号必须填写',
        'user_phone.unique'  => '手机号已注册',
        'user_email'           => '是否展示数据错误',
    ];

    // 自定义验证规则
    protected function checkPhone($value,$rule,$data=[])
    {
        $telRegex = "/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\\d{8}$/";
        if (preg_match($telRegex, $value)) {
            return true;
        } else {
            return '手机号不合法';
        }
    }

    protected $scene = [
        'register' => ['user_name','user_password','user_phone'],
        'sendSms' => ['user_phone'],
    ];
}