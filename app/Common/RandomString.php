<?php

namespace App\Common;

class RandomString{

    public static function get($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $max = strlen($strPol) - 1;

        for($i = 0; $i < $length; $i++){
            $str .= $strPol[rand(0,$max)]; //rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }

        return $str;
    }

    public static function getNumber($length){
        $str = null;
        $strPol = "0123456789";
        $max = strlen($strPol) - 1;

        for($i = 0; $i < $length; $i++){
            $str .= $strPol[rand(0,$max)]; //rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }

        return $str;
    }
}
