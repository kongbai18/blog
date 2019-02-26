<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/26 0026
 * Time: 14:26
 */

namespace app\index\controller;

use app\common\lib\exception\ApiException;
use app\index\model\Comment as CommentModel;

class Comment extends Base
{
    public function save(){
        $data = input('post.');

        //validate
        $validate = validate('Comment');
        if(!$validate->check($data)){
            throw new ApiException('1401',$validate->getError(),200);
        }

        $data['user_id'] = $this->userId;
        try{
            $model =new CommentModel();
            $result = $model->add($data);
        }catch (\Exception $e){
            throw new ApiException(1500,'系统错误');
        }

        return show(1,'添加成功',$result);
    }

    public function delete($id){
        try{
            $model =new CommentModel();

            $data = $model->find($id);
            if($data['user_id'] != $this->userId){
                throw new ApiException(1500,'系统错误');
            }

            $model->where('comment_id','=',$id)->delete();
        }catch (\Exception $e){
            throw new ApiException(1500,'系统错误');
        }

        return show(1,'删除成功！');
    }
}