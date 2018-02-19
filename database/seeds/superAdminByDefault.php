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
          'name' => 'Super Admin',
          'company_id' => 1,
          'email' => 'superadmin@gmail.com',
          'password' => bcrypt('password'),
        ]);
    }
}
