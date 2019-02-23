<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/14 0014
 * Time: 10:54
 */

namespace app\index\model;

use app\common\model\v1\Article as ArticleModel;
use app\common\model\v1\ArticleImg;
use app\common\lib\storage\Qiniu;
use think\Db;

class Article extends ArticleModel
{
    public function add($data){
        Db::startTrans();
        try{
            $this->allowField(true)->save($data);
            $articleId = $this->article_id;

            preg_match_all('/http:\/\/pic.shimentown.com.*?"/', $data['article_content'], $matches);
            $matches = $matches[0];
            foreach ($matches as &$v){
                $v = rtrim($v,'"');
            }

            if(isset($data['image']) && is_array($data['image'])){
                $diff = array_diff($matches,$data['image']);
                foreach ($diff as $v){
                    Qiniu::delete(substr($v,27));
                }
            }
            $imgData = [];
            foreach ($matches as $v1){
                $imgData[] = [
                    'article_id' => $articleId,
                    'img_url' => $v1,
                    'user_id' => $data['user_id'],
                ];
            }


            if(!empty($imgData)){
                $articleImgModel = new ArticleImg();
                $articleImgModel->saveAll($imgData);
            }
        }catch (\Exception $e){
            Db::rollnack();
            return false;
        }

        Db::commit();
        return true;

    }
}