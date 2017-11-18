<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/25 0025
 * Time: 上午 9:27
 */

namespace app\admin\controller;
use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {
        if(!session('username')){
            $this -> error('请先登录','login/index');
        }
    }

}