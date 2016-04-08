<!DOCTYPE html>
<html>
<head>
    <meta charset=UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link href="//cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link href="/assets/css/bookpay.css" rel="stylesheet"/>
    <script src="//cdn.bootcss.com/jquery/2.1.2/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>民宿预订</title>
</head>
<body>
<p><span></span>套餐选择<em></em></p>
<a><b>标间</b><u>￥929</u></a>
<div class="count">
    <span>预订<i id="count">1</i>间<span>
    <a id="reduce" onclick="reduce()" class="glyphicon glyphicon-minus"></a>
    <a id="add" onclick="add()" class="glyphicon glyphicon-plus"></a>
</div>
<p><span></span>联系人信息</p>
<input type="text" value="" placeholder="请输入姓名" >
<input type="text" value="" placeholder="请输入11位手机号" >
<script>
    function reduce(){
        var i=parseInt($("#count").html());
        if(i<=1)
            return 0;
        $("#count").html(--i);
    }
    function add(){
        var i=parseInt($("#count").html());
        $("#count").html(++i);
    }
</script>
</body>
</html>