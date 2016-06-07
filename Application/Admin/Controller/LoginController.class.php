<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class LoginController extends Controller {

    public function index(){ 
        if(session('adminUser')) {
           $this->redirect('/mysite/admin.php?c=index');
        }
        // admin.php?c=index
        $this->display();
    }

    public function check() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(!trim($username)) {
            return show(0,'用户名不能为空');
        }
        if(!trim($password)) {
            return show(0,'密码不能为空');
        }

        $ret = D('Admin')->getAdminByUsername($username);
        if(!$ret || $ret['status'] !=1) {
            return show(0,'该用户不存在');
        }

        if($ret['password'] != getMd5Password($password)) {
            return show(0,'密码错误');
        }

        D("Admin")->updateByAdminId($ret['admin_id'],array('lastlogintime'=>time()));

        session('adminUser', $ret);
        return show(1,'登录成功');


    }


    public function signup() {
        if($_POST) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password'] . C('MD5_PRE'));
        if(!trim($username)) {
            return show(0,'用户名不能为空');
        }
        if(!$email) {
            return show(0,'邮箱不能为空');
        }
        if(!trim($_POST['password'])) {
            return show(0,'密码不能为空');
        }

        $ret = D('Admin')->getAdminByUsername($username);
        if($ret) {
            return show(0,'用户已经存在');
        } else {

            $Data['username'] = $username;
            $Data['email'] = $email;
            $Data['password'] = $password;

        D("Admin")->insertNewUser($Data);

        
        return show(1,'注册成功');

        }
       
    } else {
        $this->display();
    }

    }

    /*设置即时判定用户名时候存在*/
    public function checkusername(){
       
        $username = $_POST['username'];

        if(!trim($username)) {
            return dialog.error('用户名不能为空');
        }

        $ret = D('Admin')->getAdminByUsername($username);
        if($ret) {
            return show(0,'用户名已存在');
        } else { 
            return show(1,'用户名可使用');
        }
    }
    
        


    public function loginout() {
        session('adminUser', null);
        $this->redirect('/mysite/admin.php?c=login');
    }

}