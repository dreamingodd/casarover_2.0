<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="//cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<body>
<style>
    h1{color:#BB0000; width: 400px;font:bold; text-align: center; font-size: 50px;  margin: 50px auto;}
    a{margin:100px;text-decoration: none;display: inline-block; font-size: 20px; color: #0000cc}
    label{display: block;width: 400px;margin: 0 auto; text-align: center;}
    .content{width: 600px;  margin: 100px auto;border: 1px solid skyblue;border-radius: 5px;}
</style>
<body>
<div class="content">
    <h1>跳转失败</h1>
    {{--@if($errors->any())--}}
            {{--@foreach($errors->all() as $error)--}}
    @if(isset($exception))
                <label class="list-group-item list-group-item-warning">错误信息：{{substr(get_class($exception), strrpos(get_class($exception), '\\') + 1, -9)}}</label>
    @endif
        {{--@endforeach--}}
    {{--@endif--}}
    <a href="#" onClick='javascript :history.back(-1)'>返回上页</a>
    <a href="/">返回首页</a>
</div>
</body>
</html>