<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Roles_Table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Roles')->insert([
            'id' => 1,
            'name' => 'Employee',
            'active' => true
        ]);

        DB::table('Roles')->insert([
            'id' => 2,
            'name' => 'Organisator',
            'active' => true
        ]);

        DB::table('Roles')->insert([
            'id' => 3,
            'name' => 'Admin',
            'active' => true
        ]);
    }
}
