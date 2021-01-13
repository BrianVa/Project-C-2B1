<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Users_Table extends Seeder
{
    public function run()
    {
//brian
        /*DB::table('Users')->insert([
            'firstname' => 'Brian',
            'lastname' => 'Vaartjes',
            'email' => '0952635@hr.nl',
            'verification_code' => sha1(time()),
            'verified' => 1,
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime('07/06/1995'),
            'role_id' => 4,
            'sex_id' => 1,
            'dietary' => null,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);*/
//Ingrid
        /*DB::table('Users')->insert([
            'firstname' => 'Ingrid',
            'lastname' => 'Bouman',
            'email' => '0927209@hr.nl',
            'verification_code' => sha1(time()),
            'verified' => 1,
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime('9/23/1998'),
            'role_id' => 4,
            'sex_id' => 2,
            'dietary' => null,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);*/
//Laura
        /*DB::table('Users')->insert([
            'firstname' => 'Laura',
            'lastname' => 'Bos',
            'email' => '0934987@hr.nl',
            'verification_code' => sha1(time()),
            'verified' => 1,
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime('12/12/2019'),
            'role_id' => 4,
            'sex_id' => 2,
            'dietary' => null,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);*/
//Koen
        /*DB::table('Users')->insert([
            'firstname' => 'Koen',
            'lastname' => 'Schreuder',
            'email' => '0895905@hr.nl',
            'verification_code' => sha1(time()),
            'verified' => 1,
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime('6/6/1966'),
            'role_id' => 4,
            'sex_id' => 1,
            'dietary' => null,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);*/
//Diederik
        /*DB::table('Users')->insert([
            'firstname' => 'Diederik ',
            'lastname' => 'van Walraven',
            'email' => '0896990@hr.nl',
            'verification_code' => sha1(time()),
            'verified' => 1,
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime('11/11/1911'),
            'role_id' => 4,
            'sex_id' => 1,
            'dietary' => null,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);*/
//test
        DB::table('Users')->insert([
            'firstname' => 'Test',
            'lastname' => 'Cimsolutions',
            'email' => 'test@cimsolutions.nl',
            'verification_code' => sha1(time()),
            'verified' => 1,
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime('05/03/1986'),
            'role_id' => 1,
            'sex_id' => 1,
            'dietary' => null,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
//Facilitator
        DB::table('Users')->insert([
            'firstname' => 'Organisator',
            'lastname' => 'Test',
            'email' => 'organisator@cimsolutions.nl',
            'verification_code' => sha1(time()),
            'verified' => 1,
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime('11/21/1991'),
            'role_id' => 2,
            'sex_id' => 3,
            'dietary' => null,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
//Ruud
        DB::table('Users')->insert([
            'firstname' => 'Ruud',
            'lastname' => 'Tonissen',
            'email' => 'ruud@cimsolutions.nl',
            'verification_code' => sha1(time()),
            'verified' => 1,
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime('11/21/1991'),
            'role_id' => 4,
            'sex_id' => 1,
            'dietary' => null,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

//Natnael
        DB::table('Users')->insert([
            'firstname' => 'Natnaël',
            'lastname' => 'Tefera',
            'email' => 'natnael@cimsolutions.nl',
            'verification_code' => sha1(time()),
            'verified' => 1,
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime('11/21/1991'),
            'role_id' => 4,
            'sex_id' => 1,
            'dietary' => null,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
//Marco
        DB::table('Users')->insert([
            'firstname' => 'Marco',
            'lastname' => 'Campen',
            'email' => 'm.campen@cimsolutions.nl',
            'verification_code' => sha1(time()),
            'verified' => 1,
            'password' => Hash::make('test'),
            'active' => true,
            'dateofbirth' => new DateTime('11/21/1991'),
            'role_id' => 4,
            'sex_id' => 1,
            'dietary' => null,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
