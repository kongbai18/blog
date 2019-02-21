<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3 0003
 * Time: 13:30
 */

namespace app\index\controller;

use app\common\lib\storage\Qiniu;

class Image extends Base
{
    public function _initialize()
    {

    }

    /**
     * 七牛云图片上传
     * @return array
     */
    public function upload() {
        try {
            $image = Qiniu::request_by_curl();
        }catch (\Exception $e) {
            return show(0,$e->getMessage(),'',500);
        }
        if(isset($image['key'])) {
            $data = [
                'image_url' => config('qiniu.image_url').'/'.$image['key'],
            ];
            return show(1,'',$data);
        }else {
            return show(0,'图片上传失败',$image,200);
        }
    }
}