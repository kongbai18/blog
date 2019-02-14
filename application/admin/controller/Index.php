<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/14 0014
 * Time: 12:09
 */

namespace app\admin\controller;


class Index extends Base
{
    /**
     * 前端主框架
     * @return mixed
     */
    public function index(){
        return $this->fetch();
    }

    /**
     * 前端欢迎主页面
     * @return mixed
     */
    public function welcome(){
        return $this->fetch();
    }
}