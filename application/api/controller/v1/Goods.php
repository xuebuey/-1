<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/16 0016
 * Time: 上午 11:16
 */

namespace app\api\controller\v1;


use think\Controller;
use think\Cookie;
use think\Request;
use think\Session;

class Goods extends Controller
{
    public function index($id,$name)
    {
        header("content-Type","Text/html;charset=utf-8");
        echo 'v1'.$id.'name'.$name;
    }
    public function demo(Request $request){
//        $request = Request::instance();
//        dump($request ->domain());
//        dump($request ->pathinfo());
//        dump($request ->path());
//        dump($request -> post('name'));
//        dump($request -> param('age'));
        dump($request -> session('name'));
        dump($request -> cookie(('age')));
        dump($request -> module());
        dump($request -> controller());
        dump($request -> action());
    }
    public function text()
    {
        Session::set('name','admin');
        Cookie::set('age',30);
    }
    public function input()
    {
        dump(input('post.content','','strip_tags'));
    }

}