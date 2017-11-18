<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/18 0018
 * Time: 下午 8:40
 */

namespace app\admin\controller;


use app\admin\vlidate\Links as LinksRule;
use think\Controller;
use app\admin\model\Links as LinksModel;

class Links extends Controller
{
    public function lst()
    {
        $links = LinksModel::paginate(3);
        $this ->assign('links',$links);
        return $this -> fetch();
    }
    public function edit()
    {
        $id = input('id');
        $links = db('links') -> find($id);
        if(request()->isPost()){

            //更新数据到数据库
            $data = [
                'id' => input('id'),
                'title' => input('title')
            ];
            //判断密码是否更改，没有更改则为以前的密码
            if(input('url')){
                $data['url'] = md5(input('url'));
            }else{
                $data['url'] = $links['url'];
            }

            //验证数据
            $validate = new LinksRule();
            $res = $validate ->scene('edit') -> check($data);
            if(!$res){
                $this ->error($validate->getError());
            }
            //更新数据
            if(db('links')->update($data)){
                $this -> success('修改链接成功！ ','lst');
            }else{
                $this -> error('修改链接失败！ ');
            }
            return;
        }
        //查询到的数据 ，渲染到edit页面
        $this -> assign('links',$links);
        return $this -> fetch();
    }
    public function delete()
    {
        $id = input('id');
        if(db('links') ->delete($id)){
            $this -> success('删除成功！','lst');
        }else{
            $this -> error('删除失败！','lst');
        }
        return $this -> fetch('lst');
    }
    public function add()
    {
        if(request() ->isPost()){
            $data = [
                'title' => input('title'),
                'url' => input('url'),
                'desc' => input('desc')
                ];
            $validate = new LinksRule();
            $res = $validate ->scene('add') -> check($data);
            if(!$res){
                $this ->error($validate->getError());
            }
            if(db('links')->insert($data)){
                return $this -> success('添加链接成功','lst');
            }else{
                return $this -> error('添加链接失败！');
            }
            return;
        }

        return $this -> fetch('add');
    }
}