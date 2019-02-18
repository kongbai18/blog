<?php
/**
 * Created by PhpStorm.
 * User: Administrator
<<<<<<< HEAD
 * Date: 2019/2/18 0018
 * Time: 12:31
=======
 * Date: 2019/2/16
 * Time: 15:56
>>>>>>> 1baa4ac9f2002cc1b4230df787a571bab82c9230
 */

namespace app\index\controller;

<<<<<<< HEAD
use app\common\lib\Aes;

class Test extends Base
{
    public function _initialize()
    {

    }

    public function index(){
        $Aes = new Aes();
        echo $Aes->encrypt('1550469127');
=======
use think\Cache;

class Test extends Base
{
    public function index(){
        Cache::set('name','ligo');
        $name = Cache::get('name');
        var_dump($name);
>>>>>>> 1baa4ac9f2002cc1b4230df787a571bab82c9230
    }
}