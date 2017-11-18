<?php
namespace app\index\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use think\Session;

class Index extends Base
{
   public function index()
   {
       $articleres = db('article') -> order('id desc')-> paginate(3);
       $this ->assign('articleres',$articleres);
       return $this->fetch('index');
   }

}
