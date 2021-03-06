<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class Knowledgesessions_Table extends Seeder
{
    public function run()
    {
        for ($x = 1; $x <= 20; $x++) {
            $date = new DateTime('+'.strval($x).' day');
            $date2 = new DateTime('+'.strval($x + 1).' day');
            DB::table('knowledgesessions')->insert([
                'title' => 'Test kennissessie  '.strval($x),
                'desc' => 'Dit is een test kennissessie gemaakt voor het testen.',
                'begin_date' => $date,
                'end_date' => $date2,
                'max_atendees' => 20,
                'min_atendees' => 5,
                'user_id' => User::all()->where('role_id','>',1)->random()->id,
                'active' => true,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);
        }
    }
}
