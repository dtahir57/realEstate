<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class RolesClass extends Seeder
{
    use HasRoles;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $super_user = new Role;
      $super_user->name = 'superuser';
      $super_user->guard_name = 'web';
      $super_user->save();
      $super_user->givePermissionTo('Approve-property', 'Task-transactions-all', 'Invoice-property');
      $user = User::where('email', 'superuser@gmail.com')->first();
      $user->assignRole($super_user);

      $admin = new Role;
      $admin->name = 'admin';
      $admin->guard_name = 'web';
      $admin->save();
      $admin->givePermissionTo('Approve-property', 'Task-transactions-all', 'Invoice-property');

      $agent = new Role;
      $agent->name = 'Agent';
      $agent->guard_name = 'web';
      $agent->save();
    }
}
