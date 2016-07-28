<?php
namespace App\Common;

use App\Casa;

/**  */
class CommonTools {

    /**
     * Sort casa collection by this code.
     * For instance, solve the problem which 2-101 precede 2-20.
     * @param Casa $c1
     * @param Casa $c2
     * @return -1, 0, 1
     */
    public static function sortCasaCode($c1, $c2) {
        return CommonTools::compareCasaCode($c1->code, $c2->code);
    }
    /**
     * @param Casa $c1
     * @param Casa $c2
     */
    public static function compareCasaCode($c1, $c2) {
        if (!strstr($c1, "-")) {
            return -1;
        }
        if (!strstr($c2, "-")) {
            return 1;
        }
        $c1_nums = explode("-", $c1);
        $c2_nums = explode("-", $c2);
        $c1_city = $c1_nums[0];
        $c1_casa = $c1_nums[1];
        $c2_city = $c2_nums[0];
        $c2_casa = $c2_nums[1];
        if ($c1_city < $c2_city) {
            return -1;
        } else if ($c1_city > $c2_city) {
            return 1;
        } else {
            if ($c1_casa < $c2_casa) {
                return -1;
            } else if ($c1_casa > $c2_casa) {
                return 1;
            } else return 0;
        }
    }
    /**
     * Print object in original format.
     * @param object $sth
     */
    public static function print_w($sth) {
        echo '<pre>';
        var_dump($sth);
      echo '</pre>';
    }
    public static function remove_slash($str) {
        return str_replace("\\", "", $str);
    }
    public static function getUrl($uri='') {
        $baseUrl = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
        $baseUrl .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
        $baseUrl .= isset($_SERVER['SCRIPT_NAME']) ? dirname($_SERVER['SCRIPT_NAME']) : dirname(getenv('SCRIPT_NAME'));
        return $baseUrl.'/'.$uri;
    }
    public static function getCurrentUrl() {
        return 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'.$_SERVER['HTTP_HOST']
                .(($_SERVER['SERVER_PORT'] == 80 || $_SERVER['SERVER_PORT'] == 443)
                ? '' : ':'.$_SERVER['SERVER_PORT']).$_SERVER['REQUEST_URI'];
    }
    public static function getBaseUrl() {
        $current_url = getUrl();
        $base_url = "";
        if (strpos($current_url, 'casarover/')) {
            $strs = split('casarover/', $current_url);
            $base_url = $strs[0].'casarover/';
        } else {
            $base_url = $current_url;
        }
        return $base_url;
    }
    public static function arrayToComma(Array $items) {
        $str = "";
        for ($i = 0; $i < count($items); $i++) {
            if ($i == 0) {
                $str = $items[$i];
            } else {
                $str .= "," . $items[$i];
            }
        }
        return $str;
    }
    public static function commaToArray($str) {
        $a = array();
        if (!empty($str)) {
            $a = split(",", $str);
        }
        return $a;
    }
    /**
     * Remove elements whose attr==val from an array.
     * @arr array
     * @attr attribute name
     * @val attribute value
     */
    public static function arrayRemoveElements($arr, $attr, $val) {
        $new_array = array();
        foreach ($arr as $e) {
            if ($e->$attr != $val) {
                array_push($new_array, $e);
            }
        }
        return $new_array;
    }

    /**
     * e.g. 12 -> '000012'
     */
    public static function changeToStartWithZero($number, $digit) {
        $number = floor($number);
        $lackDigit = $digit - strlen($number);
        if ($lackDigit <= 0) return $number;
        $prefix = "";
        for ($i = 0; $i < $lackDigit; $i++) {
            $prefix .= "0";
        }
        return $prefix . $number;
    }
}

?>
