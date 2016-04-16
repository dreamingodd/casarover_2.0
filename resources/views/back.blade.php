<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="//cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="/assets/js/integration/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="/assets/js/back.js"></script>
<link href="/assets/css/back.css" rel="stylesheet"/>

    @yield('head')

<title>@yield('title')</title>
</head>
<body>
<div id="container">
    <!-- nav bar start -->
    <?php include_once resource_path() . '/views/backNavigator.php';?>
    <!-- nav bar end -->

    @yield('body')
</div>
</body>
</html>
