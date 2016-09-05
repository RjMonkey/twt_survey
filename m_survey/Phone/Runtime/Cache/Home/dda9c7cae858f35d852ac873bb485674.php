<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
    <title>天外天问卷中心--登录</title>
    <link href="/Public/img/PageIcon.jpg" rel="icon">
    <link rel="stylesheet" href="/Public/css/style.css">
</head>
<body class="phoneLogin">

    <div class="content">
        <form action="/index.php/Index/check_login" method="post" >
            <div class="Login-text">
                <h2>天外天问卷中心</h2>
                <p>请使用天外天账号登录</p>
            </div>
            <div class="Login-form">
                <img src="/Public/img/Icon1.png"><input id="username" class="username"  name="username" type="text" placeholder="用户名" required>
            </div>
            <div class="Login-form Login-next">
                <img class="img23" src="/Public/img/Icon2.png"><input id="psd" class="psd2" type="password" name="password" placeholder="密码" required>
            </div>
            <div class="rememberme">
                <input id="checkinput" type="checkbox"> <span for="checkinput">记住我</span>
                <a class="modal-btn">忘记密码？</a>
            </div>
            <button id="submit" class="submit-a" name="submit">登录</button>
        </form>
    </div>

</body>
</html>