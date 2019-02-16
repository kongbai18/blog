<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/16
 * Time: 21:34
 */

namespace app\index\controller;


class Time extends Base
{
    public function _initialize(){

    }

    public function index(){
        var_dump(time());
    }
}