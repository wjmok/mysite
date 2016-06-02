<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    
    public function index(){

        $news = D('Content')->maxcount();
        $newscount = D('Content')->getNewsCount(array('status'=>1));        
        $adminCount = D("Admin")->getLastLoginUsers();

        $this->assign('news', $news);
        $this->assign('newscount', $newscount);
        
        $this->assign('admincount', $adminCount);
        $this->display();
    }

}