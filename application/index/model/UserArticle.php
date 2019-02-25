<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/25 0025
 * Time: 9:56
 */

namespace app\index\model;

use app\common\model\v1\UserArticle as UserArticleModel;
use think\Db;

class UserArticle extends UserArticleModel
{
    public function add($data){
        Db::startTrans();
        try{
            //用户文章点赞关系
            $this->allowField(true)->save($data);

            //用户点赞数
            $userModel = new User();
            $userData = $userModel->find($data['user_id']);
            $userUpData = [
                'user_id' => $data['user_id'],
                'like_count' => $userData['like_count']+1,
            ];
            $userModel->update($userUpData);

            //文章点赞数
            $articleModel = new Article();
            $articleData = $articleModel->find($data['article_id']);

            if(!$articleData){
                return false;
            }

            $articleUpData = [
                'article_id' => $data['article_id'],
                'article_like_count' => $articleData['article_like_count'] + 1,
            ];
            $articleModel->update($articleUpData);
        }catch (\Exception $e){
            Db::rollback();
            return false;
        }

        Db::commit();
        return true;
    }


    public function del($data){
        Db::startTrans();
        try{
            //用户文章点赞关系
            $this->where(['user_id'=>['eq',$data['user_id']],'article_id'=>['eq',$data['article_id']]])->delete();

            //用户点赞数
            $userModel = new User();
            $userData = $userModel->find($data['user_id']);
            $userUpData = [
                'user_id' => $data['user_id'],
                'like_count' => $userData['like_count']-1,
            ];
            $userModel->update($userUpData);

            //文章点赞数
            $articleModel = new Article();
            $articleData = $articleModel->find($data['article_id']);

            if(!$articleData){
                return false;
            }

            $articleUpData = [
                'article_id' => $data['article_id'],
                'article_like_count' => $articleData['article_like_count'] - 1,
            ];
            $articleModel->update($articleUpData);
        }catch (\Exception $e){
            Db::rollback();
            return false;
        }

        Db::commit();
        return true;
    }

    public function getUserArticle($userId){
        $data = $this->field('article_id')->where('user_id','=',$userId)->select();
        return array_column($data, 'article_id');
    }
}