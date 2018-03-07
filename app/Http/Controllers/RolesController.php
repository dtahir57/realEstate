<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RolesRequest;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
        $roles = Role::all();
        return view('Roles', compact('roles'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Roles/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {
        $role = Role::create(['name' => $request->name]);
        $permissions = $request->permissions;
        $role->givePermissionTo($permissions);
        if ($role){
            return redirect('home/Roles');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singleRecord = Role::find($id);
        return view('Roles/view', compact('singleRecord'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $find = Role::find($id);
        $permission = Permission::all();
        return view('Roles/editRole')->with(['role' => $find, 'permissions' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

          $role = Role::findOrFail($id);
          $requestData = $request->except('permissions');

          $permissions = $request->permissions;

          $role->update($requestData);

          $role->syncPermissions($permissions);

        if ($role){
            return redirect('home/Roles')->with('flash_msg', 'Updated Role');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Role::find($id);
        $del->delete();
        if ($del){
          return redirect('home/Roles')->with('del_flash', 'Role Removed Successfully');
        }
    }
}
