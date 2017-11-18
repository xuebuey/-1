<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/22 0022
 * Time: 下午 8:03
 */

namespace app\admin\controller;


use think\Controller;
use app\admin\model\Admin;

class Login extends Controller
{
    public function index()
    {
        if(request()->isPost()){
            $admin = new Admin();
            $data = $_POST;
            $num = $admin -> login($data) ;
            if($num== 3){
                $this ->success('登录成功,正在为您跳转...','admin/lst');
            }elseif($num==4){
                $this ->error('验证码作物，请重新输入','login/index');
            }else{
                $this ->error('登录失败，请重新登录','login/index');
            }
        }
        return $this -> fetch('login');
    }
}