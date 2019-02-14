<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/14 0014
 * Time: 10:40
 */

namespace app\index\controller;

use app\index\model\Label as LabelModel;

class Label extends Base
{
    /**
     * @var 标签模型
     */
    private $LabelModel;

    /**
     * 初始化 创建标签模型；
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->LabelModel = new LabelModel();
    }

    /**
     * 获取标签列表 返回数组
     * @return array
     */
    public function index(){
        try{
            $result = $this->LabelModel->getList();
        }catch (\Exception $e){
            return show(0,'label');
        }

        return show(1,'label',$result);
    }
}