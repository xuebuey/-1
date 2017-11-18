<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
//Route::pattern([
//    'id'  =>  '\d+',
//    'name'=>  '\w+'
//]);
//
//Route::rule('hello/:id','admin/Index/index','GET|POST',['https'=>false],['id'=>'\d+']);
//Route::rule('banner/:name','admin/Index/getName','GET');

Route::group('goods',function(){
    Route::get('/:id','admin/Goods/detail');
    Route::post('/add','admin/Goods/add');
    Route::any('/delete/:id','admin/Goods/delete');
});

Route::group('api/:version/goods',function(){
    Route::post('/demo2','api/:version.Goods/demo');
    Route::get('/demo3','api/:version.Goods/text');
    Route::post('/input','api/:version.Goods/input');
});