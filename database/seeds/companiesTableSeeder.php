<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class companiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
          'company_name' => str_random(10),
          'company_address' => str_random(20),
        ]);
    }
}
