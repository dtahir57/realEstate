<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionsClass extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
          'name' => 'Approve-property',
          'guard_name' => 'web'
        ]);

        DB::table('permissions')->insert([
          'name' => 'Task-transactions-own',
          'guard_name' => 'web'
        ]);

        DB::table('permissions')->insert([
          'name' => 'Task-transactions-all',
          'guard_name' => 'web'
        ]);

        DB::table('permissions')->insert([
          'name' => 'Invoice-property',
          'guard_name' => 'web'
        ]);
    }
}
