<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOpportunityApplyOwner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('opportunity_apply', function(Blueprint $t){
            $t->renameColumn('card_user_id', 'owner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opportunity_apply', function(Blueprint $t){
            $t->renameColumn('owner_id', 'card_user_id');
        });
    }
}
