<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/22 0022
 * Time: 9:35
 */

namespace app\common\model\v1;


class ArticleLabel extends Base
{
    /**
     * 获取标签对应的文章ID有序数组
     * @param $labelId
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getArticleId($labelId){
        $data = $this->field('article_id')->where('label_id','=',$labelId)->select();

        return array_values($data);
    }
}