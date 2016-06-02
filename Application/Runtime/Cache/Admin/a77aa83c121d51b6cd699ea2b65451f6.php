<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>sing后台管理平台</title>
    <!-- Bootstrap Core CSS -->
    <link href="/mysite/Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/mysite/Public/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/mysite/Public/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/mysite/Public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/mysite/Public/css/sing/common.css" />
    <link rel="stylesheet" href="/mysite/Public/css/party/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="/mysite/Public/css/party/uploadify.css">

    <!-- jQuery -->
    <script src="/mysite/Public/js/jquery.js"></script>
    <script src="/mysite/Public/js/bootstrap.min.js"></script>
    <script src="/mysite/Public/js/dialog/layer.js"></script>
    <script src="/mysite/Public/js/dialog.js"></script>
    <script type="text/javascript" src="/mysite/Public/js/party/jquery.uploadify.js"></script>

</head>
<body>

<div id="wrapper">

    <?php
 $navs = D("Menu")->getAdminMenus(); $username = getLoginUsername(); foreach($navs as $k=>$v) { if($v['c'] == 'admin' && $username != 'admin') { unset($navs[$k]); } } $index = 'index'; ?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand">singcms内容管理平台</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo getLoginUsername()?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="/mysite/admin.php?c=admin&a=personal"><i class="fa fa-fw fa-user"></i> 个人中心</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="/mysite/admin.php?c=admin"><i class="fa fa-fw fa-user"></i> 用户管理</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="/mysite/admin.php?c=login&a=loginout"><i class="fa fa-fw fa-power-off"></i> 退出</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav nav_list">
                <li>
                    <a href="/mysite/admin.php"><i class="fa fa-fw fa-dashboard"></i> 首页</a>
                </li>
                <li>
                    <a href="/mysite/admin.php?c=menu"><i class="fa fa-fw fa-dashboard"></i> 菜单管理</a>
                </li>
                <li>
                    <a href="/mysite/admin.php?c=content"><i class="fa fa-fw fa-dashboard"></i> 内容管理</a>
                </li>
                <li>
                    <a href="/mysite/admin.php?c=basic"><i class="fa fa-fw fa-dashboard"></i>基本配置</a>
                </li>
                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>


    <div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/mysite/admin.php?c=menu">菜单管理</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-edit"></i> 编辑
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-6">

                <form class="form-horizontal" id="singcms-form">
                    <div class="form-group">
                        <label for="inputname" class="col-sm-2 control-label">菜单名:</label>
                        <div class="col-sm-5">
                            <input type="text" name="name" class="form-control" id="inputname" placeholder="请填写菜单名" value="<?php echo ($menu["name"]); ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">状态:</label>
                        <div class="col-sm-5">
                            <input type="radio" name="status" id="optionsRadiosInline1" value="1" <?php if($menu["status"] == 1): ?>checked<?php endif; ?>> 开启
                            <input type="radio" name="status" id="optionsRadiosInline2" value="0" <?php if($menu["status"] == 0): ?>checked<?php endif; ?>> 关闭
                        </div>

                    </div>
                    <input type="hidden" name="menu_id" value="<?php echo ($menu["menu_id"]); ?>"/>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" id="singcms-button-submit">更新</button>
                    </div>
                </div>
                </form>


            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- Morris Charts JavaScript -->
<script>

    var SCOPE = {
        'save_url' : '/scms/admin.php?c=menu&a=add',
        'jump_url' : '/scms/admin.php?c=menu',
    }
</script>
<script src="/mysite/Public/js/admin/common.js"></script>



</body>

</html>