<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/18 0018
 * Time: 下午 8:40
 */

namespace app\admin\controller;


use app\admin\vlidate\Admin as AdminRule;
use app\admin\model\Admin as AdminModel;

class Admin extends Base
{
    public function lst()
    {
        $list = AdminModel::paginate(3);
        $this ->assign('list',$list);
        return $this -> fetch();
    }
    public function edit()
    {
        $id = input('id');
        $admins = db('admin') -> find($id);
        if(request()->isPost()){

            //更新数据到数据库
            $data = [
                'id' => input('id'),
                'username' => input('username')
            ];
            //判断密码是否更改，没有更改则为以前的密码
            if(input('password')){
                $data['password'] = md5(input('password'));
            }else{
                $data['password'] = $admins['password'];
            }

            //验证数据
            $validate = new AdminRule();
            $res = $validate ->scene('edit') -> check($data);
            if(!$res){
                $this ->error($validate->getError());
            }
            //更新数据
            if(db('admin')->update($data)){
                $this -> success('修改管理员成功！ ','lst');
            }else{
                $this -> error('修改管理员失败！ ');
            }
            return;
        }
        //查询到的数据 ，渲染到edit页面
        $this -> assign('admins',$admins);
        return $this -> fetch();
    }
    public function delete()
    {
        $id = input('id');
        if($id != 3){
            if(db('admin') ->delete($id)){
                $this -> success('删除成功！','lst');
            }else{
                $this -> error('删除失败！','lst');
            }
        }else{
            $this -> error('初始化管理员不能删除');
        }
        return $this -> fetch('lst');
    }
    public function add()
    {
        if(request() ->isPost()){
            $data = [
                'username' => input('username'),
                'password' => md5(input('password'))
            ];
            $validate = new AdminRule();
            $res = $validate ->scene('add') -> check($data);
            if(!$res){
                $this ->error($validate->getError());
            }
            $sava = db('admin')->insert($data);
            if($sava !== false){
                return $this -> success('添加成功','lst');
            }else{
                return $this -> error('添加失败！');
            }
            return;
        }

        return $this -> fetch('add');
    }
    public function logout()
    {
        session(null);
        $this -> success('退出登录成功','login/index');
    }
}