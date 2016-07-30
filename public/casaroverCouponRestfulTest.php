<?php
// 需要替换成任意字符串
$order_id = '513';


// 1.Get new coupon. Replace code and key with dealer's.
$url = "http://www.casarover.com/rest/get-new-coupon?code=YWD&key=RVDW&price=2000&order_id=" . $order_id;
$responseJson = file_get_contents($url);
$responseData = json_decode($responseJson);
var_dump($responseData);
echo '<br />';
$coupon = $responseData->data;
var_dump($coupon);
echo '<br />';

// 2.Get coupon with coupon_no.
$coupon_no = $coupon->coupon_no;
$url = "http://www.casarover.com/rest/get-coupon?coupon_no=" . $coupon_no;
$responseJson = file_get_contents($url);
$responseData = json_decode($responseJson);
var_dump($responseData);
echo '<br />';

// 3.Get coupon with code and order_id.
$url = "http://www.casarover.com/rest/get-coupon?code=YWD&order_id=" . $order_id;
$responseJson = file_get_contents($url);
$responseData = json_decode($responseJson);
var_dump($responseData);
