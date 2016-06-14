<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

/**
 * 文章内容管理
 */
class ContentController extends CommonController
{

    public function index()
    {
        $conds = array();
        $title = $_GET['title'];
        if ($title) {
            $conds['title'] = $title;
        }
        if ($_GET['menu_id']) {
            $conds['menu_id'] = intval($_GET['menu_id']);
        }

        $page     = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 10;

        $news  = D("Content")->getNews($conds, $page, $pageSize);
        $count = D("Content")->getNewsCount($conds);

        $res     = new \Think\Page($count, $pageSize);
        $pageres = $res->show();

        $this->assign('pageres', $pageres);
        $this->assign('news', $news);

        $this->assign('webSiteMenu', D("Menu")->getBarMenus());
        $this->display();
    }

    public function add()
    {

        if ($_POST) {
            if (!isset($_POST['title']) || !$_POST['title']) {
                return show(0, '标题不存在');
            }
            if (!isset($_POST['small_title']) || !$_POST['small_title']) {
                return show(0, '短标题不存在');
            }

            if (!isset($_POST['keywords']) || !$_POST['keywords']) {
                return show(0, '关键字不存在');
            }
            if (!isset($_POST['content']) || !$_POST['content']) {
                return show(0, '内容不存在');
            }
            if ($_POST['news_id']) {
                return $this->save($_POST);
            }
            $newsId = D("Content")->insert($_POST);
            if ($newsId) {

                return show(1, '新增成功');

            } else {
                return show(0, '新增失败');
            }

        } else {

            $webSiteMenu = D("Menu")->getBarMenus();
            $this->assign('webSiteMenu', $webSiteMenu);
            $this->display();
        }
    }

    public function edit()
    {

        $webSiteMenu = D("Menu")->getBarMenus();
        $this->assign('webSiteMenu', $webSiteMenu);
        $contentId = $_GET['id'];
        $content = D("Content")->find($contentId);
        $GLOBALS['abc'] =$content['thumb'];
        $this->assign('news', $content);
        $this->display();
    }


    public function save($data)
    {
        $newsId = $data['news_id'];
        unset($data['news_id']);

        try {
            $id = D("Content")->updateById($newsId, $data);
            if ($id === false) {
                return show(0, '更新失败');
            }
            return show(1, '更新成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }

    }
    public function setStatus()
    {
        try {
            if ($_POST) {
                $id     = $_POST['id'];
                $status = $_POST['status'];
                if (!$id) {
                    return show(0, 'ID不存在');
                }
                $res = D("Content")->updateStatusById($id, $status);
                if ($res) {
                    return show(1, '操作成功');
                } else {
                    return show(0, '操作失败');
                }
            }
            return show(0, '没有提交的内容');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function listorder()
    {
        $listorder = $_POST['listorder'];
        $jumpUrl   = $_SERVER['HTTP_REFERER'];
        $errors    = array();
        try {
            if ($listorder) {
                foreach ($listorder as $newsId => $v) {
                    // 执行更新
                    $id = D("News")->updateNewsListorderById($newsId, $v);
                    if ($id === false) {
                        $errors[] = $newsId;
                    }
                }
                if ($errors) {
                    return show(0, '排序失败-' . implode(',', $errors), array('jump_url' => $jumpUrl));
                }
                return show(1, '排序成功', array('jump_url' => $jumpUrl));
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
        return show(0, '排序数据失败', array('jump_url' => $jumpUrl));
    }

    public function deletpic()
    {
        $picurl = $_POST['src'];

        if (file_exists($picurl)) {

            if (!unlink($picurl)) {
                return show(0, '操作失败');
            } else {
                return show(1, '操作成功');
            }
        } else {
            return show(0, '没找到文件');
        }

    }

}
