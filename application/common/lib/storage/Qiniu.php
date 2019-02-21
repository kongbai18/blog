<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 9:31
 */

namespace app\common\lib\storage;

vendor('qiniu.autoload');
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class Qiniu
{
    /**
     * 图片上传
     */
    public static function image() {
        var_dump(input('post.'));
        if(empty($_FILES['file']['tmp_name'])) {
            exception('您提交的图片数据不合法', 404);
        }
        /// 要上传的文件的
        $file = $_FILES['file']['tmp_name'];

        /*$ext = explode('.', $_FILES['file']['name']);
        $ext = $ext[1];*/
        $pathinfo = pathinfo($_FILES['file']['name']);

        $ext = $pathinfo['extension'];

        $config = config('qiniu');
        // 构建一个鉴权对象
        $auth  = new Auth($config['ak'], $config['sk']);
        //生成上传的token
        $token = $auth->uploadToken($config['bucket']);
        // 上传到七牛后保存的文件名
        $key  = date('Y')."/".date('m')."/".substr(md5($file), 0, 5).date('YmdHis').rand(0, 9999).'.'.$ext;

        //初始UploadManager类
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $file);

        if($err !== null) {
            return null;
        } else {
            return $key;
        }
    }

    public static function request_by_curl(){
        $remote_server = 'http://upload.qiniu.com/putb64/-1/key/';
        $ext = pathinfo(input('post.image._name'));
        $mill_time = microtime();
        $timeInfo = explode(' ', $mill_time);
        $milis_time = sprintf('%d%03d',$timeInfo[1],$timeInfo[0] * 1000);

        $key  = date('Y')."/".date('m')."/".date('d').'/'.$milis_time.rand(0, 9999).'.'.$ext['extension'];

        $key = base64_encode($key);
        $key = str_replace(array('+','/'),array('-','_'),$key);
        $remote_server = $remote_server.$key;
        $post_string = input('post.image.miniurl');
        $post_string = strstr($post_string,'base64,');
        $post_string = substr($post_string,7);

        $auth  = new Auth(config('qiniu.ak'), config('qiniu.sk'));
        $upToken = $auth->uploadToken(config('qiniu.bucket'), null, 3600);//获取上传所需的token

        $headers = array();
        $headers[] = 'Content-Type:image/png';
        $headers[] = 'Authorization:UpToken '.$upToken;
        //$headers[] = 'Authorization:EncodedKey sada54.jpg';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$remote_server);
        //curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data,true);
    }

    /**
     * 图片删除
     */
    public static function delete($key){
        $config = config('qiniu');

        $auth  = new Auth($config['ak'], $config['sk']);

        $qiniuConfig = new Config();
        $bucketManager = new BucketManager($auth, $qiniuConfig);

        $err = $bucketManager->delete($config['bucket'], $key);

        return $err;
    }
}