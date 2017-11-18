<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/19 0019
 * Time: 下午 2:14
 */

namespace app\admin\model;


use think\captcha\Captcha;
use think\Db;
use think\Model;

class Admin extends Model
{
    public function login($data)
    {
        $captcha = new Captcha();
        if(!$captcha -> check($data['code'])){
            return 4;
        }
        $user = Db::name('admin') -> where('username','=',$data['username']) -> find();
        if($user){
            if($user['password'] == md5($data['password'])){
                session('username',$user['username']);
                session('uid',$user['id']);
                return 3;               //  用户名，密码正确
            }else{
                return 2;       //密码输入错误
            }
        }else{
            return 1;       //用户不存在
        }
    }
}