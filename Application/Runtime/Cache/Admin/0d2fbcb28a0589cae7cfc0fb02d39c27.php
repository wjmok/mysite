<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="">
    <title>注册页面</title>
</head>

<body>
    
        <div class="form-group" >
            <label for="exampleInputPassword1">用户名</label>
            <input type="username" class="form-control" id="username" placeholder="username">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">邮箱地址</label>
            <input type="email" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox"> Check me out
            </label>
        </div>
        <button type="submit" class="btn btn-default" onclick="sign.signup()">注册</button>
    
    <script src="/mysite/Public/js/jquery.js"></script>
    <script src="/mysite/Public/js/dialog/layer.js"></script>
    <script src="/mysite/Public/js/dialog.js"></script>
    <script src="/mysite/Public/js/admin/login.js"></script>
    <link rel="stylesheet" type="text/css" href="/mysite/Public/css/bootstrap.min.css">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
</body>

</html>