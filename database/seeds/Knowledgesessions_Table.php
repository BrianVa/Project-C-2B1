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
        for ($x = 1; $x <= 20; $x++) {
            $date = new DateTime('+'.strval($x).' week');
            $date2 = new DateTime('+'.strval($x + 1).' week');
            DB::table('knowledgesessions')->insert([
                'title' => 'kennissessie '.strval($x),
                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at dignissim eros. Aliquam porttitor at lacus quis pretium. Vestibulum egestas efficitur viverra. Pellentesque posuere, metus eget pretium luctus, nisl nisi facilisis dolor, in dignissim velit quam non massa. Phasellus sagittis massa sit amet hendrerit posuere. Donec dapibus, nulla et consectetur vulputate, lectus ex dapibus dui, id pulvinar mauris magna et lacus. Curabitur ac feugiat mi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus lacinia pellentesque eros.',
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
