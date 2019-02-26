<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/20 0020
 * Time: 10:30
 */

namespace app\index\model;

use app\common\model\v1\User as UserModel;

class User extends UserModel
{
    public function add($data){
        $this->allowField(true)->save($data);
    }

    public function getUserInfo($userId,$moreInfo = false){
        //基本信息
        $user = $this->field('user_id,user_name,user_photo_url,concern_count,fans_count,like_count,content_count,brief')->find($userId);

        if($moreInfo){
            //关注用户信息
            $UserConcernModel = new UserConcern();
            $userConcern = $UserConcernModel->getUserConcern($userId);

            //关注话题信息
            $UserCateModel = new UserCate();
            $userCate = $UserCateModel->getUserCate($userId);

            //喜欢文章信息
            $UserArticleModel = new UserArticle();
            $userArticle = $UserArticleModel->getUserArticle($userId);

            return [
                'user' => $user,
                'userConcern' => $userConcern,
                'userCate' => $userCate,
                'userArticle' => $userArticle,
            ];
        }else{
            return $user;
        }

    }
}