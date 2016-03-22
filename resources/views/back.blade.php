<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="//cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="//cdn.bootcss.com/jquery/2.1.2/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<link href="{{ asset('assets/css/back.css') }} " rel="stylesheet"/>
<script src="assets/js/back.js"></script>

    @yield('head')

<title>@yield('title')</title>
</head>
<body
<div id="container">
    <!-- nav bar start -->
    <?php include_once resource_path() . '/views/backNavigator.php';?>
    <!-- nav bar end -->

    @yield('body')

</div>
</body>
</html>
