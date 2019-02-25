<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/25 0025
 * Time: 10:47
 */

namespace app\index\controller;

use app\common\lib\exception\ApiException;
use app\index\model\UserArticle as UserArticleModel;

class Userarticle extends Base
{
    public function save(){
        $data = input('post.');

        //validate
        $validate = validate('Userarticle');
        if(!$validate->check($data)){
            $this->error($validate->getError());
        }

        $data['user_id'] = $this->userId;


        $model = new UserArticleModel();
        $userArticleData = $model->where(['user_id'=>['eq',$data['user_id']],'article_id'=>['eq',$data['article_id']]])->find();
        if($userArticleData){
            return show(1,'点赞成功');
        }
        $result = $model->add($data);

        if($result){
            return show(1,'点赞成功');
        }

        return show(0,'点赞失败');
    }

    public function delete(){
        $data = input('delete.');

        //validate
        $validate = validate('Userarticle');
        if(!$validate->check($data)){
            $this->error($validate->getError());
        }

        $data['user_id'] = $this->userId;

        $model = new UserArticleModel();
        $userArticleData = $model->where(['user_id'=>['eq',$data['user_id']],'article_id'=>['eq',$data['article_id']]])->find();
        if(!$userArticleData){
            return show(1,'取消点赞成功');
        }

        $result = $model->del($data);

        if($result){
            return show(1,'取消点赞成功');
        }

        return show(0,'取消点赞失败');

    }
}