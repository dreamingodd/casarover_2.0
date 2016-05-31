<?php

use App\Entity\Wx\Wx18;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MockWxUserCasa18 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userId = 100;
        $casaId = 4;

        for ($i = 0; $i < 50; $i++) {
            $wac = new Wx18();
            $wac->wx_user_id = $userId + $i;
            $wac->wx_casa_id = $casaId + $i % 2;
            $wac->vote = rand(0, $i * 3);
            $wac->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
