<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/14 0014
 * Time: 10:54
 */

namespace app\common\model\v1;


use app\common\lib\exception\ApiException;

class Article extends Base
{
    public function getArticleList($data){
        $sortData = ['a.article_id'=>'desc'];
        $whereData = [];

        //分类主题
        if(isset($data['cate_id']) && !empty($data['cate_id'])){
            $categoryModel = new Category();
            $cateArr = $categoryModel->getChildSelf($data['cate_id']);
            $cateArr =implode(',',$cateArr);
            $whereData['a.article_cate_id'] = ['in',$cateArr];
        }

        if(isset($data['label_id']) && !empty($data['label_id'])){
            $ArticleLabelModel = new ArticleLabel();
            $articleId = $ArticleLabelModel->getArticleId($data['label_id']);
            $whereData['a.article_id'] = ['in',$articleId];
        }

        if(isset($data['keywords']) && !empty($data['keywords'])){
            $whereData['a.article_name'] = ['like','%'.trim($data['article_name']).'%'];
        }

        if(isset($data['user_id']) && !empty($data['user_id'])){
            $whereData['a.user_id'] = ['eq',$data['user_id']];
        }

        $total = $this->getArticleCount($whereData);
        $this->getPageAndSize($data);
        $pageTotal = ceil($total/$this->size);
        if(isset($data['page']) && $data['page'] > $pageTotal){
            $this->page = $pageTotal;
        }

        $article = $this->getArticle($whereData,$sortData,$this->from,$this->size);

        $pageData = [
            'total' => $total,
            'page_total' => $pageTotal,
            'page_num' => $this->page,
            'page_size' => $this->size,
        ];

        $data = [
            'pageData' => $pageData,
            'article' => $article,
        ];

        return $data;
    }

    /**
     * 获取文章总数
     * @param $whereData
     * @return int|string
     */
    private function getArticleCount($whereData){
        return $this->alias('a')->where($whereData)->count();
    }

    public function getArticle($whereData=[],$sortData=[],$from='',$size=''){

        // 执行查询
        $list = $this->field(['a.*','b.user_name','b.user_photo_url',
            "group_concat(c.img_url) AS article_pic"
        ])->alias('a')
            ->join('user b','a.user_id = b.user_id','left')
            ->join('article_img c','a.article_id = c.article_id','left')
            ->where($whereData)
            ->order($sortData)
            ->limit($from,$size)
            ->group('a.article_id')
            ->select();

        return $list;
    }

    public function getArticleInfo($id){
        $data = $this->field('a.*,b.user_name,b.user_photo_url')
            ->alias('a')
            ->join('user b','a.user_id = b.user_id','left')
            ->find($id);

        if($data){
            $commentModel = new Comment();
            $commentData = $commentModel->getCommentList($id);
            return [
                'article' => $data,
                'comment' => $commentData,
            ];
        }

        throw new ApiException(1404,'不存在',404);
    }
}