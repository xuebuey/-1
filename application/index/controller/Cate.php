<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/17 0017
 * Time: 下午 10:05
 */

namespace app\index\controller;


class Cate extends Base
{
    public function index()
    {
        $cateid = input('cateid');
        $cates = db('cate') -> find($cateid);
        $this -> assign('cates',$cates);
        $articleres = db('article') -> where(array('cateid'=>$cateid)) -> paginate(3);
        $this ->assign('articleres',$articleres);
        return $this -> fetch('list');
    }
}