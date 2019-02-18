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
    public function index(){
        $model = new CategoryModel();
        $result = $model->getList();

        return $this->fetch('index',['cateData'=>$result]);
    }

    public function add(){
        $model = new CategoryModel();

        if($this->request->isPost()){
            $data = input('post.');
            //validate
            $validate = validate('Category');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }

            try{
                $model->add($data);
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }

            $this->success('添加分类成功','index');
        }else{
            $cateData = $model->getList();
            return $this->fetch('',[
                'cateData' => $cateData,
            ]);
        }
    }

    public function edit(){
        $model = new CategoryModel();
        if($this->request->isPost()){
            $data = input('post.');
            //validate
            $validate = validate('Category');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }

            try{
                $model->edit($data);
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }

            $this->success('修改分类成功','index');
        }else{
            try{
                $cateData = $model->getList();
                $cateInfo = $model->find(input('get.cateId'));
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }

            return $this->fetch('',[
                'cateData' => $cateData,
                'cateInfo' => $cateInfo,
            ]);
        }
    }

    public function delete(){

    }
}