<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 17:31
 */

namespace app\index\controller;

use app\index\model\Category as CategoryModel;

class Category extends Base
{
    /**
     * @var 分类模型
     */
    private $CategoryModel;

    /**
     * 初始化 创建分类模型
     */
    public function _initialize()
    {
        parent::_initialize();

    }

    /**
     * 获取分类列表；返回树状分类数组
     * @return array
     */
    public function index(){
        try{
            $model = new CategoryModel();
            $result = $model->getTwoStage();
        }catch (\Exception $e){
            return show(0,'');
        }

        return show(1,'',$result);
    }

    public function read(){

    }
}