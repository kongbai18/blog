<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/16
 * Time: 12:54
 */

namespace app\admin\model;

use app\common\model\v1\Label as LabelModel;

class Label extends LabelModel
{
    public function add($data){
        var_dump($data);
        $this->allowField(true)->save($data);
    }

    public function edit($data){
        $this->allowField(true)->update($data);
    }
}