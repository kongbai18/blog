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
    protected $field = true;
    protected  $autoWriteTimestamp = true;

}