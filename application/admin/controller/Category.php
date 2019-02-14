<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 17:31
 */

namespace app\admin\controller;

use app\admin\model\Category as CategoryModel;

class Category extends Base
{
    private $CategoryModel;

    public function _initialize()
    {
        parent::_initialize();
        $this->CategoryModel = new CategoryModel();
    }

    public function index(){
        $result = $this->CategoryModel->getList();

        return $this->fetch('index',['cateData'=>$result]);
    }

    public function read(){

    }

    public function add(){
        /*$data = input('post.');

        //validate
        $validate = validate('Category');
        if(!$validate->check($data)){
            return show(0,$validate->getError());
        }

        $result = $this->CategoryModel->add($data);

        if($result){
            return show(config('code.addSuccess'),'');
        }

        return show(config('code.addFail'),'');*/

        return $this->fetch();

    }

    public function update(){

    }

    public function delete(){

    }
}