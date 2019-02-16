<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/16
 * Time: 12:53
 */

namespace app\admin\controller;

use app\admin\model\Label as LabelModel;

class Label extends Base
{
    public function index(){
        $model = new LabelModel();
        $result = $model->getList();

        return $this->fetch('index',['labelData'=>$result]);
    }

    public function add(){
        $model = new LabelModel();

        if($this->request->isPost()){
            $data = input('post.');

            //validate
            $validate = validate('Label');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }

            try{
                $model->add($data);
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }

            $this->success('添加标签成功','index');
        }else{
            return $this->fetch();
        }
    }

    public function edit(){
        $model = new LabelModel();
        if($this->request->isPost()){
            $data = input('post.');
            //validate
            $validate = validate('Label');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }

            try{
                $model->edit($data);
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }

            $this->success('修改标签成功','index');
        }else{
            try{
                $labelInfo = $model->find(input('get.labelId'));
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }

            return $this->fetch('',[
                'labelInfo' => $labelInfo,
            ]);
        }
    }
}