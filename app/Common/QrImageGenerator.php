<?php

namespace App\Common;

use QRcode;

/**
 * Contains methods to generate the QCcode Image.
 */
class QrImageGenerator {
    public static function generate($text, $file) {
        include public_path() . '/assets/phpqrcode/phpqrcode.php';
        QRcode::png($text, $file);
    }
}
