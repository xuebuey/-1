<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20 0020
 * Time: 下午 1:54
 */

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Cate as CateModel;
use app\admin\vlidate\Cate as CateRule;

class Cate extends Base
{
    public function lst()
    {
        $list = CateModel::paginate(3);
        $this ->assign('list',$list);
        return $this -> fetch();
    }
    public function edit()
    {
        $id = input('id');
        $admins = db('cate') -> find($id);
        if(request()->isPost()){

            //更新数据到数据库
            $data = [
                'id' => input('id'),
                'catename' => input('catename')
            ];


            //验证数据
            $validate = new CateRule();
            $res = $validate ->scene('edit') -> check($data);
            if(!$res){
                $this ->error($validate->getError());
            }
            //更新数据
            if(db('cate')->update($data)){
                $this -> success('修改栏目成功！ ','lst');
            }else{
                $this -> error('修改栏目失败！ ');
            }
            return;
        }
        //查询到的数据 ，渲染到edit页面
        $this -> assign('cate',$admins);
        return $this -> fetch();
    }
    public function delete()
    {
        $id = input('id');
            if(db('cate') ->delete($id)){
                $this -> success('删除成功！','lst');
            }else{
                $this -> error('删除失败！','lst');
            }
        return $this -> fetch('lst');
    }
    public function add()
    {
        $data['catename']=input('catename');
        if(request() ->isPost()){
            $validate = new CateRule();
            $res = $validate -> check($data);
            if(!$res){
                $this ->error($validate->getError());
            }

            if(db('cate')->insert($data)){
                return $this -> success('添加成功','lst');
            }else{
                return $this -> error('添加失败！');
            }
            return;
        }

        return $this -> fetch('add');
    }
}