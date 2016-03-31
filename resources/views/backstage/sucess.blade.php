<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
    h1{color: #00AA00; width: 400px;font:bold; text-align: center; font-size: 50px;  margin: 50px auto;padding-bottom:100px}
    a{margin:54px;;text-decoration: none; font-size: 20px; color: #0000cc}
    .content{width: 600px; height: 400px; margin: 100px auto;border: 1px solid skyblue;border-radius: 5px;}
</style>
<body>
<div class="content">
    <h1>上传成功</h1>
    <a href="#" onClick='javascript :history.back(-1)'>返回上页</a>
    <?php $url="#" ;?>
    @if($type==1)
        @if($id==0)
                <?php $url='http://localhost:81/back/wechatSeriesList';?>
        @else
                <?php $url="http://localhost:81/back/wechatEdit" ;?>
        @endif
    @endif
    @if($type==2)
                <?php $url="http://localhost:81/back/wechatEdit" ;?>
    @endif
    @if($type==3)
                <?php $url="http://localhost:81/back/wechatEdit" ;?>
    @endif

    <a href="{{$url}}">浏览效果</a>
    <a href="/">返回首页</a>
</div>
</body>
</html>