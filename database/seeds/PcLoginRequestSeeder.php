<?php

use Illuminate\Database\Seeder;

class PcLoginRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Entity\PcLoginRequest::class, 5)->create();
    }
}
