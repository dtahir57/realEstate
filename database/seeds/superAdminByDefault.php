<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class superAdminByDefault extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'name' => 'Super User',
          'email' => 'superuser@gmail.com',
          'password' => bcrypt('password'),
        ]);
    }
}
