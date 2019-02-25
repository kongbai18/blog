<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/25 0025
 * Time: 16:23
 */

namespace app\index\controller;

use app\index\model\UserCate as UserCateModel;

class Usercate extends Base
{
    public function save(){
        $data = input('post.');

        //validate
        $validate = validate('Usercate');
        if(!$validate->check($data)){
            $this->error($validate->getError());
        }

        $data['user_id'] = $this->userId;


        $model = new UserCateModel();
        $userCateData = $model->where(['user_id'=>['eq',$data['user_id']],'cate_id'=>['eq',$data['cate_id']]])->find();
        if($userCateData){
            return show(1,'关注成功');
        }
        $result = $model->add($data);

        if($result){
            return show(1,'关注成功');
        }

        return show(0,'关注失败');
    }


    public function delete(){
        $data = input('delete.');

        //validate
        $validate = validate('Usercate');
        if(!$validate->check($data)){
            $this->error($validate->getError());
        }

        $data['user_id'] = $this->userId;

        $model = new UserCateModel();
        $userCateData = $model->where(['user_id'=>['eq',$data['user_id']],'cate_id'=>['eq',$data['cate_id']]])->find();
        if(!$userCateData){
            return show(1,'取消关注成功');
        }

        $result = $model->del($data);

        if($result){
            return show(1,'取消关注成功');
        }

        return show(0,'取消关注失败');

    }
}