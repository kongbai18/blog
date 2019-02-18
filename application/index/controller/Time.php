<?php
/**
 * Created by PhpStorm.
 * User: Administrator
<<<<<<< HEAD
 * Date: 2019/2/18 0018
 * Time: 10:03
=======
 * Date: 2019/2/16
 * Time: 21:34
>>>>>>> 1baa4ac9f2002cc1b4230df787a571bab82c9230
 */

namespace app\index\controller;


class Time extends Base
{

    public function _initialize(){

    }

    public function index(){
        $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        $str = '';

        $arr_len = count($arr);

        for ($i = 0; $i < $arr_len; $i++)

        {

            $rand = mt_rand(0, $arr_len-1);

            $str.=$arr[$rand];

        }
        return show(1,'OK',['time'=>time(),'str'=>$str]);
    }
}