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
        $html = "<p><img src=\"http://pic.shimentown.com/2019/02/21/15507421579982333.png\" alt=\"微信图片_20181109150546.png\" /><img src=\"http://pic.shimentown.com/2019/02/21/15507425466567044.png\" alt=\"logo.png\" /></p>";
        preg_match_all('/http:\/\/pic.shimentown.com.*?"/', $html, $matches);
        var_dump($matches);
    }
}