<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/14 0014
 * Time: 10:54
 */

namespace app\index\model;

use app\common\model\v1\Article as ArticleModel;

class Article extends ArticleModel
{
    public function add($data){
        $this->allowField(true)->save($data);
    }
}