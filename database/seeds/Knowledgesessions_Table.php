<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class Knowledgesessions_Table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

// sessies
        DB::table('knowledgesessions')->insert([
            'id' => 1,
            'title' => 'Basis sessie',
            'desc' => 'Dit is de eerste sessie die je nodig hebt',
            'begin_date' => new DateTime('10/11/2020 11:00:00'),
            'end_date' => new DateTime('10/11/2020 12:00:00'),
            'max_atendees' => 10,
            'min_atendees' => 5,
            'user_id' => User::all()->random()->id,
            'active' => true,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('knowledgesessions')->insert([
            'id' => 2,
            'title' => 'Basis sessie2',
            'desc' => 'Dit is de eerste sessie die je nodig hebt',
            'begin_date' => new DateTime('10/11/2020 11:00:00'),
            'end_date' => new DateTime('10/11/2020 12:00:00'),
            'max_atendees' => 10,
            'min_atendees' => 5,
            'user_id' => User::all()->random()->id,
            'active' => true,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('knowledgesessions')->insert([
            'id' => 3,
            'title' => 'Basis sessie3',
            'desc' => 'Dit is de eerste sessie die je nodig hebt',
            'begin_date' => new DateTime('10/11/2020 11:00:00'),
            'end_date' => new DateTime('10/11/2020 12:00:00'),
            'max_atendees' => 10,
            'min_atendees' => 5,
            'user_id' => User::all()->random()->id,
            'active' => true,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
