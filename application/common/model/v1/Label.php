<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/14 0014
 * Time: 10:41
 */

namespace app\common\model\v1;


class Label extends Base
{
    /**
     * 获取标签列表
     * 默认筛选展示项
     * 默认按排序的升序排列
     * @param string $search
     * @return false|\PDOStatement|string|\think\Collection
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

        return $list;
    }
}