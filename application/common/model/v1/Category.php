<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/21 0021
 * Time: 17:30
 */

namespace app\common\model\v1;


class Category extends Base
{
    /**
     * 获取分类数据，对数据进行树状化
     * 默认筛选显示项
     * 默认按排序序号升序排列
     * @param string $search
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getList($search = ''){
        // 筛选条件
        $filter = [];
        $filter['is_index'] = ['eq','1'];
        !empty($search) && $filter['name'] = ['like', '%' . trim($search) . '%'];

        // 排序规则
        $sort = ['order_id' => 'asc'];

        // 执行查询
        $list = $this
            ->where($filter)
            ->order($sort)
            ->select();

        //树状化
        $list = $this->_getTree($list);
        return $list;
    }

    /**
     * 对分类数据进行树状化
     * @param $data 权限数据
     * @param int $parentId 第一级父类ID
     * @param int $level 第一级级别
     * @return array
     */
    private function _getTree($data,$parentId=0,$level=0){
        static $ret =array();
        foreach($data as $k => $v){
            //halt($v);
            if($v->parent_cate_id == $parentId){
                $v['level'] = $level;
                $ret[] = $v;
                //找子分类
                $this->_getTree($data,$v->cate_id,$level+1);
            }
        }
        return $ret;
    }

    /*
     * 获取分类的两级列表
     */
    public function getTwoStage(){
        $filter['is_index'] = ['eq','1'];
        // 排序规则
        $sort = ['order_id' => 'asc'];

        // 执行查询
        $list = $this
            ->where($filter)
            ->order($sort)
            ->select();


        $rdata = [];
        foreach ($list as $v){
            if($v['parent_cate_id'] == 0){
                $child = [];
                foreach ($list as $v1){
                    if($v1['parent_cate_id'] == $v['cate_id']){
                        $child[] = $v1;
                    }
                }
                $v['child'] = $child;
                $rdata[] = $v;
            }
        }
        return $rdata;
    }

    /**
     * 获取分类子集及本身
     * @param $id 分类Id值
     * @return array 返回集合数组
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getChildSelf($id){
        //获得所有分类数据
        $data = $this->getList();
        $child = $this->_getChild($id,$data,true);
        $child[] = $id;
        return $child;
    }

    /**
     * 获取分类子集
     * @param $id 分类ID
     * @param $data 分类所有集合
     * @param bool $isClear
     * @return array
     */
    private function _getChild($id,$data,$isClear = FALSE){
        static $child = array();
        if($isClear){
            $child = [];
        }
        //循环从数据中找出子类
        foreach($data as $k => $v){
            if($v['parent_cate_id']==$id){
                $child[] = $v['cate_id'];
                $this->_getChild($v['cate_id'],$data,FALSE);
            }
        }
        return $child;
    }
}