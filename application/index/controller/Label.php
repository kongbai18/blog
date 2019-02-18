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
     * 获取标签列表 返回数组
     * @return array
     */
    public function index(){
        try{
            $model = new LabelModel();
            $result = $model->getList();
        }catch (\Exception $e){
            return show(0,'label');
        }

        return show(1,'label',$result);
    }
}