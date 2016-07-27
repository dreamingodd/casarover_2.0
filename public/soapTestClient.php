<?php

$soap = new SoapClient(null, array('location' => 'http://localhost/soaptest', 'uri' => 'http://soap/'));
echo $soap->show();
//得到：'the data you request!'
echo $soap->getUserInfo('sss');
