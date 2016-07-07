<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" href="/assets/css/common.css">
<link rel="stylesheet" href="/assets/css/pcWxLogin.css">
<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script>
$(function(){
    $('.close').click(function(){
        window.close();
    });
});
</script>
<title>确认登录</title>
</head>
<body>
<div class="close">
    <a href="#">关闭</a>
</div>
<div class="show">
    <div class="logo">
        <img src="/assets/images/logo.png" alt="">
    </div>
</div>
@if ($plr)
<div class="make-sure">
    <p>
        确认登录探庐者
    </p>
    <a href="">
        确认登录
    </a>
    <a href="">
        取消登录
    </a>
</div>
@else
<div class="make-sure">
    <p>
        二维码已过期，请刷新网页！
    </p>
</div>
@endif
</body>
</html>
