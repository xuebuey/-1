<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/19 0019
 * Time: 上午 10:49
 */

namespace app\admin\vlidate;


use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title' => 'require|max:10',
    ];
    //验证提示信息
    protected $message = [
        'title.require' => '文章标题必须填写',
        'title.max' => '文章标题长度不大于10位',
    ];

}