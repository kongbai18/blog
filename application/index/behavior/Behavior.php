<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/18 0018
 * Time: 10:41
 */

namespace app\index\behavior;


class Behavior
{
    public function responseSend(&$params)
    {
        //跨域访问的时候才会存在此字段
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

        $allow_origin = array(
            'http://localhost:8080',
        );

        if(in_array($origin, $allow_origin)) {
            header('Access-Control-Allow-Origin:' . $origin);
            header('Access-Control-Allow-Methods:POST,GET,PUT,DELETE,OPTIONS');
            header('Access-Control-Allow-Headers:Accept,Referer,Host,Keep-Alive,User-Agent,X-Requested-With,Cache-Control,Content-Type,Cookie,token');
            header('Access-Control-Allow-Credentials:true');

            if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
                exit;
            }
        }
    }
}