<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::resource('index/v1/time','index/time',['only'=>['index']]);
Route::resource('index/v1/category','index/category',['only'=>['index','read']]);
Route::resource('index/v1/label','index/label',['only'=>['index']]);
Route::resource('index/v1/user','index/user',['only'=>['index','read']]);
Route::resource('index/v1/article','index/article',['only'=>['index','read','save','delete']]);
Route::resource('index/v1/userarticle','index/userarticle',['only'=>['save','delete']]);
Route::resource('index/v1/usercate','index/usercate',['only'=>['save','delete']]);
Route::resource('index/v1/comment','index/comment',['only'=>['save','delete']]);


Route::post('index/v1/login','index/user/login');
Route::post('index/v1/logout','index/user/logout');
Route::post('index/v1/register','index/user/register');
Route::post('index/v1/sendsms','index/user/sendSms');
Route::post('index/v1/upimage','index/image/upload');
Route::post('index/v1/gettwostage','index/category/getTwoStage');
Route::post('index/v1/personalarticle','index/article/getPersonalArticle');
