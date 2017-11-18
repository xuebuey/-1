<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/19 0019
 * Time: 上午 10:49
 */

namespace app\admin\vlidate;


use think\Validate;

class Admin extends Validate
{
    protected $rule = [
       'username'       =>      'require|max:20',
        'password'      =>       'require'
    ];
    //验证规则
    //验证提示信息
    protected $message = [
        'username.require' => '管路员名称必须填写',
        'username.max' => '管理员名称长度不大于20位',
        'password.require' => '管理员密码必须填写'
    ];
    protected $scene = [
        'add'  => ['username','password'],
        'edit'  => ['username']
    ];
}