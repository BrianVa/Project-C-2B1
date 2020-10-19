<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Sex_Table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Sex')->insert([
            'id' => 1,
            'name' => 'Man',
            'active' => true
        ]);

        DB::table('Sex')->insert([
            'id' => 2,
            'name' => 'Vrouw',
            'active' => true
        ]);

        DB::table('Sex')->insert([
            'id' => 3,
            'name' => 'Overig',
            'active' => true
        ]);
    }
}
