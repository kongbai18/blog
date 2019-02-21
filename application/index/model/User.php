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
}