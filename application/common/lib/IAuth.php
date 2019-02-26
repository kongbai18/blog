<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/18 0018
 * Time: 13:41
 */

namespace app\common\lib;

use think\Cache;

class IAuth
{
    /**
     * 设置密码
     * @param string $data
     * @return string
     */
    public static  function setPassword($data) {
        return md5($data.config('dishu.password_key'));
    }

    /**
     * 检查sign是否正常
     * @param array $data
     * @param $data
     * @return boolen
     */
    public static function checkSignPass($data) {
        $str = (new Aes())->encrypt($data['timestamp'].$data['str']);
        if($str != $data['sign']) {
            return false;
        }

        if ((time() - $data['timestamp']) > config('daishu.app_sign_time')) {
            return false;
        }

        // 唯一性判定
        if (Cache::get($data['sign'])) {
            return false;
        }
   
        return true;
    }
}