<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/19 0019
 * Time: 下午 2:14
 */

namespace app\admin\model;


use think\Model;

class Article extends Model
{
    public function cate()
    {
        return $this -> belongsTo('cate','cateid');
    }
}