<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/21 0021
 * Time: 17:30
 */

namespace app\common\model\v1;


use think\Model;

class Base extends Model
{
    protected  $field = true;
    protected  $autoWriteTimestamp = true;

    /**
     * page
     * @var string
     */
    public $page = '';

    /**
     * 每页显示多少条
     * @var string
     */
    public $size = '';
    /**
     * 查询条件的起始值
     * @var int
     */
    public $from = 0;

    /**
     * 获取分页page size 内容
     */
    public function getPageAndSize($data) {
        $this->page = (isset($data['page']) && !empty($data['page'])) ? $data['page'] : 1;
        $this->size = (isset($data['size']) && !empty($data['size'])) ? $data['size'] : config('paginate.list_rows');
        $this->from = ($this->page - 1) * $this->size;
    }
}