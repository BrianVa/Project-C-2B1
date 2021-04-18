<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Sessionorders_Table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sessionorders')->insert([
            'user_id' => 1,
            'know_id'=> 1,
            'sign_up_at' => new DateTime(),
            'cancelled' => 0,
            'attended' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
