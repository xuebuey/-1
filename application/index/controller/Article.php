<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/17 0017
 * Time: 下午 10:04
 */

namespace app\index\controller;


class Article extends Base
{
    public function index()
    {
        $arid = input('arid');
        $articles = db('article') -> find($arid);
        db('article') -> where('id','=',$arid) ->setInc('click');
        $articleres = $this -> relat($articles['keywords'],$arid);
        $recres = db('article') -> where(array('id'=>$articles['id'],'state'=>1)) -> limit(8) ->select();
        $cates = db('cate') -> find($articles['cateid']);
        $this -> assign( array(
               'articles'=>$articles,
               'cates'   =>$cates,
            'recres'     =>$recres,
            'articleres'=> $articleres
           ));
        return $this -> fetch('article');
    }
    public function relat($keywords,$id)
    {
        $arr  = explode(',',$keywords);
        static $articleres = array();
        foreach ($arr as $k =>$v){
            $map['keywords'] = ['like','%'.$v.'%'];
            $map['id'] = ['neq',$id];
            $res = db('article') -> where($map) -> order('id desc')->limit(8) -> select();
            $articleres = array_merge($articleres,$res);
            return $articleres;
        }
        $articleres = array_unique($articleres);
    }
}