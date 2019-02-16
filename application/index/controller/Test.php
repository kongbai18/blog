<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/16
 * Time: 15:56
 */

namespace app\index\controller;

use think\Cache;

class Test extends Base
{
    public function index(){
        Cache::set('name','ligo');
        $name = Cache::get('name');
        var_dump($name);
    }
}