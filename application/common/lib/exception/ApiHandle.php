<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 16:21
 */

namespace app\common\lib\exception;

use think\exception\Handle;

class ApiHandle extends Handle
{
    /**
     * http 状态码
     * @var int
     */
    public $httpCode = 500;
    public $code = 0;

    public function render(\Exception $e) {

        if(config('app_debug') == true) {
            return parent::render($e);
        }
        if ($e instanceof ApiException) {
            $this->httpCode = $e->httpCode;
            $this->code = $e->code;
        }
        return  show($this->code,$e->getMessage(), [], $this->httpCode);
    }
}