<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/19 0019
 * Time: 上午 10:49
 */

namespace app\admin\vlidate;


use think\Validate;

class Links extends Validate
{
    protected $rule = [
       'title'       =>      'require|max:20',
        'url'        =>       'require',
    ];
    //验证规则
    //验证提示信息
    protected $message = [
        'title.require' => '链接标题必须填写',
        'title.max' => '链接标题长度不大于20位',
        'url.require' => '链接地址必须填写',
    ];
    protected $scene = [
        'add'  => ['title','url'],
        'edit'  => ['title','url'],
    ];
}