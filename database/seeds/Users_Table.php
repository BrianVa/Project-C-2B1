<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Users_Table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//brian
        DB::table('Users')->insert([
            'firstname' => 'Brian',
            'lastname' => 'Vaartjes',
            'email' => '0952635@hr.nl',
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime('06/07/1995'),
            'role_id' => 3,
            'sex_id' => 1,
            'dietary' => '0',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
//Ingrid
        DB::table('Users')->insert([
            'firstname' => 'Ingrid',
            'lastname' => 'Bouman',
            'email' => '0927209@hr.nl',
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime(),
            'role_id' => 3,
            'sex_id' => 2,
            'dietary' => '0',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
//Laura
        DB::table('Users')->insert([
            'firstname' => 'Laura',
            'lastname' => 'Bos',
            'email' => '0934987@hr.nl',
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime(),
            'role_id' => 3,
            'sex_id' => 2,
            'dietary' => '0',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
//Koen
        DB::table('Users')->insert([
            'firstname' => 'Koen',
            'lastname' => 'Schreuder',
            'email' => '0895905@hr.nl',
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime(),
            'role_id' => 3,
            'sex_id' => 1,
            'dietary' => '0',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
//Diederik
        DB::table('Users')->insert([
            'firstname' => 'Diederik ',
            'lastname' => 'van Walraven',
            'email' => '0896990@hr.nl',
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime(),
            'role_id' => 3,
            'sex_id' => 1,
            'dietary' => '0',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
