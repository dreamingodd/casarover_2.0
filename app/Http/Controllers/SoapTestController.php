<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Http\Requests;
use App\Http\Controllers\Test;

class SoapTestController extends Controller
{
    function getUserInfo($name)
    {
        return 'fbbin';
    }
    public function test() {
        Log::info(get_class() . " has been called!");
        //实例化的参数手册上面有，这个是没有使用wsdl的，所以第一个参数为null，如果有使用wsdl，那么第一个参数就是这个wsdl文件的地址。
        $server = new SoapServer(null, array('location' => 'http://localhost/soaptest', 'uri' => 'http://soap/'));
        $t = new Test();
        $server->setClass('t');
        $server->addFunction('getUserInfo');
        $server->handle();
    }
}
