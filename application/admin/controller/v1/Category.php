<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 17:31
 */

namespace app\admin\controller\v1;

use app\admin\model\v1\Category as CategoryModel;

class Category extends Base
{
    private $CategoryModel;

    public function _initialize()
    {
        parent::_initialize();
        $this->CategoryModel = new CategoryModel();
    }

    public function index(){
        $result = $this->CategoryModel->getCateTree();

        if($result){
            return show(1,'');
        }

        return show(0,'');
    }

    public function read(){

    }

    public function save(){
        $data = input('post.');

        //validate
        $validate = validate('Category');
        if(!$validate->check($data)){
            return show(0,$validate->getError());
        }

        $result = $this->CategoryModel->add($data);

        if($result){
            return show(1,'');
        }

        return show(0,'');

    }

    public function update(){

    }

    public function delete(){

    }
}