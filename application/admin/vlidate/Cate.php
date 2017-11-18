<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20 0020
 * Time: 下午 1:56
 */

namespace app\admin\vlidate;


use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'catename'       =>      'require|max:10'
    ];
    //验证提示信息
    protected $message = [
        'catename.require' => '栏目名称必须填写',
        'catename.max' => '栏目名称长度不大于10位'
    ];

}