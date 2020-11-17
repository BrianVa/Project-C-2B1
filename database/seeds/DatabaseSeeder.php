<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('Roles_Table');
        $this->call('Sex_Table');
        $this->call('Users_Table');
        $this->call('Knowledgesessions_Table');
    }
}
