<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/18 0018
 * Time: 12:31
 */

namespace app\index\controller;

use app\common\lib\Aes;

class Test extends Base
{
    public function _initialize()
    {

    }

    public function index(){
        $Aes = new Aes();
        echo $Aes->encrypt('1550469127');
    }
}