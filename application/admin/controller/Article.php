<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/18 0018
 * Time: 下午 8:40
 */

namespace app\admin\controller;


use app\admin\vlidate\Article as ArticleRule;
use app\admin\model\Article as ArticleModel;
use think\Db;

class Article extends Base
{
    public function lst()
    {
        $article = ArticleModel::paginate(3);
//        $article = db('article') -> alias('a') -> join('cate c','c.id=a.cateid') -> field('a.id,a.title,a.author,a.state,a.pic,a.cateid,c.catename') -> paginate(3);
        $this ->assign('article',$article);
        return $this -> fetch('lst');
    }
    public function edit()
    {
        $id = input('id');
        $article = db('article') -> find($id);
        if(request()->isPost()){
            //更新数据到数据库
            $data = [
                'id' => input('id'),
                'title' => input('title'),
                'author' => input('author'),
                'desc' => input('desc'),
                'keywords' => str_replace('，',',',input('keywords')),
                'content' => input('content'),
                'pic' => input('pic'),
                'click' => input('click'),
                'state' => input('state'),
                'time' => input('time'),
                'cateid' => input('cateid')
            ];


            //验证数据
            $validate = new ArticleRule();
            $res = $validate ->scene('edit') -> check($data);
            if(!$res){
                $this ->error($validate->getError());
            }
            if(input('state') == 'on'){
                $data['state'] = 1;
            }else{
                $data['state'] = 0;
            }

            if($_FILES['pic']['tmp_name']){
//                @unlink('/static'.$article['pic']);
                $file =  request() -> file('pic');
                $info = $file ->move(ROOT_PATH .'public'.DS. 'static/uploads');
//                dump($info);die;
                $data['pic'] = '/uploads/'.$info->getSaveName();
//                dump($data['pic']);die;
            }
            //更新数据
            if(db('article')->update($data)){
                $this -> success('修改文章成功！ ','lst');
            }else{
                $this -> error('修改文章失败！ ');
            }
            return;
        }
        //查询到的数据 ，渲染到edit页面
        $this -> assign('article',$article);

        $cateres = db('cate') -> select();
        $this -> assign('cateres',$cateres);
        return $this -> fetch();
    }
    public function delete()
    {
        $id = input('id');
        if($id != 3){
            if(db('article') ->delete($id)){
                $this -> success('删除成功！','lst');
            }else{
                $this -> error('删除失败！','lst');
            }
        }else{
            $this -> error('初始化文章不能删除');
        }
        return $this -> fetch('lst');
    }
    public function add()
    {

        if(request() ->isPost()){
            $data = [
                'title' => input('title'),
                'author' => input('author'),
                'desc' => input('desc'),
                'keywords' => str_replace('，',',',input('keywords')),
                'content' => input('content'),
                'pic' => input('pic'),
                'time' => time(),
                'cateid' => input('cateid')
            ];
//            dump($data);die;
            if(input('state') == 'on'){
                $data['state'] = 1;
            }
            //判断是否上传图片
            if($_FILES['pic']['tmp_name']){
                $file =  request() -> file('pic');
                $info = $file ->move(ROOT_PATH .'public'.DS. 'static/uploads');
//                dump($info);die;
                $data['pic'] = '/uploads/'.$info->getSaveName();
//                dump($data['pic']);die;
            }
            $validate = new ArticleRule();
            $res = $validate -> check($data);
            if(!$res){
                $this ->error($validate->getError());
            }


            if(Db::name('article')->insert($data)){
                return $this -> success('添加成功','lst');
            }else{
                return $this -> error('添加失败！');
            }
            return;
        }

        $cateres = db('cate') -> select();
        $this -> assign('cateres',$cateres);
        return $this -> fetch('add');
    }
}