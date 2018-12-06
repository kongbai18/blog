<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 17:33
 */

namespace app\admin\model\v1;

use app\common\model\v1\Category as CategoryModel;

class Category extends CategoryModel
{
    public function add($data){
        try{
            $this->allowField(true)->insert($data);
        }catch (\Exception $e){
            return false;
        }
        return true;
    }

}