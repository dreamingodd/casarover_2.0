<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
require('routes/siteRoutes.php');
require('routes/backRoutes.php');
require('routes/apiRoutes.php');
require('routes/wxRoutes.php');
require('routes/mobileRoutes.php');
require('routes/merchantRoutes.php');
require('routes/webserviceRoutes.php');
