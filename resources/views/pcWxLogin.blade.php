<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" href="/assets/css/common.css">
<link rel="stylesheet" href="/assets/css/pcWxLogin.css">
<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<!-- 如果断网
<script src="/assets/js/integration/jquery.min.js"></script>
-->
<script>
$.ajax('/wx/pc-wx-login/check/{{$plr->code}}', {
    // 1s = 100
    timeout: 10000,
    success: function(data) {
        if (data.msg) {
            if (data.msg === "approved") {
                // %20 => /
                location.href = decodeURIComponent((data.redirect_url + '').replace(/\+/g, '%20'));
            } else if (data.msg === "rejected") {
                alert("登录请求被拒绝！");
            } else if (data.msg === "timeout") {
                alert("探庐君提醒您，您的验证码超时了，请刷新后重试！");
            } else {
                alert("探庐君不认识返回码:" . data.msg);
            }
        } else {
            alert("探庐君处理请求累垮了，请稍后再试！");
            console.log(data);
        }
    },
    error: function(data, textStatus, errorThrown) {
        if (textStatus === "timeout") {
            alert("探庐君提醒您，您的验证码超时了！！！");
        } else {
            alert("探庐君处理请求累垮了，请稍后再试！");
            console.log(textStatus);
            console.log(errorThrown);
            console.log(data.responseText);
        }
    }
});
</script>
<title>微信登录</title>
</head>
<body>
<div class="show">
    <div class="logo">
        <img src="/assets/images/logo.png" alt="">
    </div>
</div>
<div class="qrcode">
    <img src="{{$qrPath}}" alt="">
</div>
<div class="make-sure">
    <p>
        请使用 <strong>微信</strong> 扫描登录探庐者
    </p>
</div>
</div>
</body>
</html>
