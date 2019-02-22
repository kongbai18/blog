<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/14 0014
 * Time: 10:54
 */

namespace app\index\controller;

use app\common\lib\exception\ApiException;
use app\index\model\Article as ArticleModel;

class Article extends Base
{
    public function _initialize()
    {
        parent::checkRequestAuth();
    }

    public function index(){
        $data = input('get.');
        try{
            $model = new ArticleModel();
            $data = $model->getArticleList($data);
        }catch (\Exception $e){
            throw new ApiException(1500,$e->getMessage());
        }

        return show(1,'获取成功',$data);
    }

    public function read($id){
        try{
            $model = new ArticleModel();
            $data = $model->getArticleInfo($id);
        }catch (\Exception $e){
            throw new ApiException(1500,$e->getMessage(),500);
        }

        return show(1,'获取信息成功',$data);
    }

    public function save()
    {
        parent::checkLogin();

        $data = input('post.');
        $data['user_id'] = $this->userId;

        $model = new ArticleModel();
        $result = $model->add($data);
        if ($result) {
            return show(1, '添加成功');
        }

        return show(0, '添加失败');
    }

    public function getPersonalArticle(){
        parent::checkLogin();
        $data = input('post.');
        $data['user_id'] = $this->userId;
        try{
            $model = new ArticleModel();
            $result = $model->getArticleList($data);
        }catch (\Exception $e){
            throw new ApiException(1500,$e->getMessage(),500);
        }
        return show(1,'获取信息成功！',$result);
    }

}