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
    public function getCateTree(){
        try{
            $data = $this->where('is_index','eq',1)->select();
            $tree = $this->_getTree($data,0,1,true);
        }catch (\Exception $e){
            return false;
        }

        return $tree;
    }

    private function _getTree($data,$parentId = 0,$level = 1,$isUpdate = false){
        if($isUpdate){
            static $tree = [];
        }

        foreach ($data as $k => $v){
            if($v['parent_cate_id'] == $parentId){
                $v['level'] = $leve;
                $tree[] = $v;
                unset($data[$k]);

                $this->_getTree($data,$v['cate_id'],$level + 1);
            }
        }
    }

    public function add($data){
        try{
            $this->allowField(true)->insert($data);
        }catch (\Exception $e){
            return false;
        }
        return true;
    }

}