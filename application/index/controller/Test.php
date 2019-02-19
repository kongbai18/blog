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


use app\common\lib\Tencentsms;

class Test extends Base
{
    public function _initialize()
    {

    }

    public function index()
    {
        $data = Tencentsms::sendSms(865743,18720920196,config('tencent.registerId'));
        var_dump($data);
    }
}