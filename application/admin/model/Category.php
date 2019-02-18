<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/21 0021
 * Time: 17:20
 */

namespace app\admin\model;

use app\common\model\v1\Category as CategoryModel;

class Category extends CategoryModel
{
    public function add($data){
        $this->allowField(true)->save($data);
    }
    
    public function edit($data){
        $this->allowField(true)->update($data);
    }

}