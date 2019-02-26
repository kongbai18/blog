<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 16:55
 */

namespace app\index\controller;

use app\index\model\User as UserModel;
use app\common\lib\exception\ApiException;
use app\common\lib\Tencentsms;
use app\common\lib\IAuth;
use think\Session;

class User extends Base
{
    public function _initialize()
    {
        parent::checkRequestAuth();
    }

    public function index(){
        parent::checkLogin();
        $model = new UserModel();
        $userId = Session::get('blog.user_session');
        try{
            $data = $model->getUserInfo($userId,true);
        }catch (\Exception $e){
            throw new ApiException(1500,$e->getMessage());
        }

        return show(1,'获取信息成功',$data);
    }

    public function read($id){
        $model = new UserModel();
        try{
            $data = $model->getUserInfo($id);
        }catch (\Exception $e){
            throw new ApiException(1500,$e->getMessage());
        }

        return show(1,'获取信息成功',$data);
    }

    public function login(){
        $data = input('post.');
        $model = new UserModel();
        $user = [];

        $telRegex = "/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\\d{8}$/";
        $emailRegex= '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
        if (preg_match($telRegex, $data['user_name'])) {
            $user = $model->where(['user_phone'=>['eq',$data['user_name']]])->find();
        }else if(preg_match($emailRegex, $data['user_name'])){
            $user = $model->where(['user_email'=>['eq',$data['user_name']]])->find();
        }else{
            $user = $model->where(['user_name'=>['eq',$data['user_name']]])->find();
        }

        if($user){
            if($user['user_password'] == IAuth::setPassword($data['user_password'])){
                $udata = [
                    'user_id' => $user['user_id'],
                    'user_last_login_time' => time(),
                    'user_last_login_ip' => request()->ip(),
                ];

                try{
                    $model->update($udata);
                }catch (\Exception $e){
                    throw new ApiException(1500,'系统错误');
                }

                Session::set('blog.user_session',$user['user_id']);
                return show(1,'登陆成功',['user_name'=>$user['user_name'],'user_url'=>$user['user_photo_url']]);
            }else{
                return show(0,'密码错误!');
            }
        }else{
            return show(0,'用户不存在!');
        }

        return show(0,'登陆失败!');

    }

    public function logout(){
        try{
            Session::delete('blog.user_session');
        }catch (\Exception $e){
            throw new ApiException(1500,'系统错误');
        }

        return show(1,'退出成功');
    }

    public function register(){
        $data = input('post.');

        $code = Session::get('phoneCode');
        if($code){
            $sessionPhone = Session::get('phone');
            if(!$sessionPhone || $sessionPhone != $data['user_phone']){
                return show(0,'验证码错误');
            }
            $codeTime =  Session::get('phoneCodeTime');
            if($codeTime && (time()-$codeTime > 300)){
                Session::delete('phoneCode');
                Session::delete('phoneCodeTime');
                return show(0,'验证码已失效');
            }else{
                if($code != $data['code']){
                    return show(0,'验证码错误');
                }
            }
        }else{
            return show(0,'请先获取验证码');
        }

        //validate
        $validate = validate('User');
        if(!$validate->scene('register')->check($data)){
            throw new ApiException('1401',$validate->getError(),200);
        }

        try{
            $model = new UserModel();
            $data['user_photo_url'] = 'http://pic.shimentown.com/header'.rand(1,10).'.jpg';
            $data['user_password'] = IAuth::setPassword($data['user_password']);
            $model->add($data);
        }catch (\Exception $e){
            return show(0,$e->getMessage(),[],500);
        }

        Session::delete('phone');
        Session::delete('phoneCode');
        Session::delete('phoneCodeTime');

        return show(1,'注册成功');
    }

    public function sendSms(){
        $data = input('post.');

        //validate
        $validate = validate('User');
        if(!$validate->scene('sendSms')->check($data)){
            throw new ApiException('1401',$validate->getError(),200);
        }

        $code = rand(100000,999999);
        $result = Tencentsms::sendSms($code,$data['user_phone'],config('tencent.registerId'));
        if($result){
            Session::set('phoneCode',$code);
            Session::set('phone',$data['user_phone']);
            Session::set('phoneCodeTime',time());
            return show(1,'验证码发送成功');
        }else{
            return show(0,'验证码发送失败');
        }
    }
}