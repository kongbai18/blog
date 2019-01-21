<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 16:22
 */

namespace app\common\lib\exception;

use think\Exception;

class ApiException extends Exception
{
    public $message = '';
    public $httpCode = 500;
    public $code = config('code.sysError');
    /**
     * @param string $message
     * @param int $httpCode
     * @param int $code
     */
    public function __construct($code = config('code.sysError'),$message = '', $httpCode = 500) {
        $this->httpCode = $httpCode;
        $this->message = $message;
        $this->code = $code;
    }
}