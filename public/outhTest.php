<?php
$appid='wxeafd79d8fcbd74ee';
$appsecret='5db9a898bdd7f430bbc563476021f4b2';
$wxCode='041WFFTx0wV83n1h3NTx0iaETx0WFFTZ';
$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='
 . $appid . '&secret=' . $appsecret .'&code=' . $wxCode . '&grant_type=authorization_code';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
$res = curl_exec($ch);
curl_close($ch);
$jsonObj = json_decode($res, true);
var_dump($jsonObj);
var_dump($jsonObj['access_token']);
var_dump(empty($jsonObj['access_token']));
