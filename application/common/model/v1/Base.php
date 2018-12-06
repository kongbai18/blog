<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 17:34
 */

namespace app\common\model\v1;


use think\Model;

class Base extends Model
{
    protected $field = true;
    protected  $autoWriteTimestamp = true;

}