<?php

namespace App\Services;

use App\Entity\Coupon;
use App\Entity\Dealer;

class CouponService {
    public function checkParameters($code, $key, $price) {
        $dealer = Dealer::where('code', $code)->where('key', $key)->get();
        dd($dealer);
    }
    public function createCoupon($code, $key, $price) {

        Coupon::create([

        ]);
    }
}
