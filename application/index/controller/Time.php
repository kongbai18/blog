<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/18 0018
 * Time: 10:03
 */

namespace app\index\controller;


class Time extends Base
{
    public function _initialize()
    {

    }

    public function index(){
        return show(1,'获取时间成功',time());
    }
}