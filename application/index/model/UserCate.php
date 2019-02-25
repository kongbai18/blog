<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/25 0025
 * Time: 9:56
 */

namespace app\index\model;

use app\common\model\v1\UserCate as UserCateModel;
use think\Db;

class UserCate extends UserCateModel
{
    public function add($data){
        Db::startTrans();
        try{
            //用户文章关注关系
            $this->allowField(true)->save($data);

            //话题关注数
            $cateModel = new Category();
            $CateDate = $cateModel->find($data['cate_id']);

            if(!$CateDate){
                return false;
            }

            $cateUpData = [
                'cate_id' => $data['cate_id'],
                'concern_count' => $CateDate['concern_count'] + 1,
            ];
            $cateModel->update($cateUpData);
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
            //用户话题关注关系
            $this->where(['user_id'=>['eq',$data['user_id']],'cate_id'=>['eq',$data['cate_id']]])->delete();


            //话题关注数
            $cateModel = new Category();
            $CateDate = $cateModel->find($data['cate_id']);

            if(!$CateDate){
                return false;
            }

            $cateUpData = [
                'cate_id' => $data['cate_id'],
                'concern_count' => $CateDate['concern_count'] - 1,
            ];
            $cateModel->update($cateUpData);
        }catch (\Exception $e){
            Db::rollback();
            return false;
        }

        Db::commit();
        return true;
    }

    public function getUserCate($userId){
        $data = $this->field('cate_id')->where('user_id','=',$userId)->select();
        return array_column($data, 'cate_id');
    }
}