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
    public function index(){
        try{
            $model = new ArticleModel();
            $data = $model->select();
        }catch (\Exception $e){
            throw new ApiException(1500,'系统错误');
        }

        return show(1,'获取成功',$data);
    }

    public function save()
    {
        $data = input('post.');

        try{
            $model = new ArticleModel();
            $data = $model->add($data);
        }catch (\Exception $e){
            throw new ApiException(1500,'系统错误');
        }

        return show(1,'添加成功',$data);
    }
}