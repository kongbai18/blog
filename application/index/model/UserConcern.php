<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/25 0025
 * Time: 9:55
 */

namespace app\index\model;

use app\common\model\v1\UserConcern as userConcernModel;

class UserConcern extends userConcernModel
{
    public function getUserConcern($userId){
        $data = $this->field('concerned_user_id')->where('concern_user_id','=',$userId)->select();
        return array_values($data);
    }
}