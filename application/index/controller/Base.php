<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/25 0025
 * Time: 上午 10:09
 */

namespace app\index\controller;


use think\Controller;
use think\Db;

class Base extends Controller
{
    public function _initialize()
    {
        $cateres = Db::name('cate') -> order('id desc') -> select();
        $this -> right();
        $this -> assign('cateres',$cateres);
    }
    public function right()
    {
        $click = \db('article') -> order('click desc') ->limit(8) -> select();
        $read = \db('article') -> where('state','=',1) -> order('click desc') ->limit(8) -> select();
        $this -> assign(
            array(
                'click' => $click,
                'read' => $read
            )
        );



    }

}