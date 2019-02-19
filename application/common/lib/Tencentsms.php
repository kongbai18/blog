<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/19 0019
 * Time: 17:21
 */

namespace app\common\lib;

vendor('tencentsms.index');
use Qcloud\Sms\SmsSingleSender;
use traits\model\SoftDelete;

class Tencentsms
{
    public static function sendSms($code,$phone,$templateId){
        try {
            $ssender = new SmsSingleSender(config('tencent.AppID'), config('tencent.AppKey'));
            $params = [$code];
            $result = $ssender->sendWithParam("86", $phone, $templateId,
                $params, config('tencent.sign'), "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
            $rsp = json_decode($result,true);
            var_dump($rsp);
            if($rsp['result'] == 0){
                return true;
            }else{
                return false;
            }
        } catch(\Exception $e) {
            return false;
        }
    }
}