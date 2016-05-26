<!DOCTYPE html>
<html>
<head>
    <meta charset=UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link href="//cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link href="/assets/css/activityCommon.css" rel="stylesheet"/>
    <script src="//cdn.bootcss.com/jquery/2.1.2/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>@yield('title')</title>
    @yield('head')
</head>
<body>
@yield('body')
<footer>
    <ul>
        <li><a href="/activity" ></a></li>
        <li><a href="/activity/person" ></a></li>
        <li><a href="/activity/rank" ></a></li>
        <li><a href="#" ></a></li>
    </ul>
</footer>
</body>
</html>
