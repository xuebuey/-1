<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/16 0016
 * Time: 上午 9:27
 */

namespace app\admin\controller;


use think\Controller;
use think\Config;

class Index extends Controller
{
    public function index()
    {
        return $this -> fetch();
    }



}