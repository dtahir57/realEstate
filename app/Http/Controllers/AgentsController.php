<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Auth;
use Hash;
use Session;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
class AgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware(['auth', 'middleware' => 'role:admin|superuser']);
     }
    public function index()
    {
        if (Session::has('company_id')) {
          $agents = User::role('Agent')->where('company_id', session('company_id'))->get();
          $user = User::where('company_id', session('company_id'))->first();
          return view('companies/Agents', compact('agents', 'user'));
        }
        $id = Auth::user()->id;
        $user = User::find($id);
        $agents = User::role('Agent')->where('company_id', $user->company_id)->get();
        return view('Agents', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth::user()->hasRole('superuser') AND Session::has('company_id')) {
          $user = User::where('company_id', session('company_id'))->first();
          return view('companies/Agents/create', compact('user'));
        }
        return view('Agents/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          //check if role 'Agent' has any permission by default and if agent have any permissions , it will first drop them all.
          $role = Role::where('name', 'Agent')->first();
          $p = array();
          $p = DB::table('role_has_permissions')->where('role_id', $role->id)->get();
          foreach($p as $d) {
              $role->revokePermissionTo($d);
          }
          $user = DB::table('users')->where('company_id', session('company_id'))->first();
          $_user = new User;
          $_user->company_id = session('company_id');
          $_user->name = $request->name;
          $_user->email = $request->email;
          $_user->password = Hash::make($request->password);
          $_user->save();
          $property = $request->property;
          $transaction = $request->transaction;
          $_user->givePermissionTo($property, $transaction);
          $_user->assignRole('Agent');
          if ($_user) {
            Session::flash('success', 'Agent Created Successfully!');
            $agents = User::role('Agent')->where('company_id', session('company_id'))->get();
            return view('companies/Agents', compact('user', 'agents'));
          }
        }
        $role = Role::where('name', 'Agent')->first();
        $p = array();
        $p = DB::table('role_has_permissions')->where('role_id', $role->id)->get();
        foreach($p as $d) {
            $role->revokePermissionTo($d);
        }
        $userId = Auth::user()->id;

        $company = User::find($userId);

        $user = new User;
        $user->company_id = $company->company_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $property = $request->property;
        $transaction = $request->transaction;
        $user->givePermissionTo($property, $transaction);
        $user->assignRole('Agent');
        if ($user) {
          Session::flash('success', 'Agent Created Successfully!');
          return redirect('home/Agents');
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
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $agent = User::find($id);
          $user = DB::table('users')->where('company_id', session('company_id'))->first();
          return view('companies/Agents/details', compact('agent', 'user'));
        }
        $agent = User::find($id);
        return view('Agents/details', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $agent = User::find($id);
          $user = DB::table('users')->where('company_id', session('company_id'))->first();
          return view('companies/Agents/edit', compact('agent', 'user'));
        }
        $agent = User::find($id);
        return view('Agents/editAgent', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $agent = User::find($id);
          $agent->company_id = session('company_id');
          $agent->name = $request->name;
          $agent->email = $request->email;
          $agent->password = Hash::make($request->password);
          $agent->save();
          $property = $request->property;
          $transaction = $request->transaction;
          $agent->syncPermissions($property, $transaction);
          if ($agent) {
            Session::flash('updated', 'Agent Information Updated Successfully!');
            $agents = User::role('Agent')->where('company_id', session('company_id'))->get();
            $user = User::where('company_id', session('company_id'))->first();
            return view('companies/Agents', compact('agents', 'user'));
          }
        }
        $userId = Auth::user()->id;
        $company = User::find($userId);
        $agent = User::find($id);
        $agent->company_id = $company->company_id;
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->password = Hash::make($request->password);
        $agent->save();
        $property = $request->property;
        $transaction = $request->transaction;
        $agent->syncPermissions($property, $transaction);
        if ($agent) {
          Session::flash('updated', 'Agent Information Updated Successfully!');
          return redirect('home/Agents');
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
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $agent = User::find($id);
          $agent->delete();
          if ($agent) {
            Session::flash('deleted', 'Agent Deleted!');
            $agents = User::role('Agent')->where('company_id', session('company_id'))->get();
            $user = User::where('company_id', session('company_id'))->first();
            return view('companies/Agents', compact('agents', 'user'));
          }
        }
        $agent = User::find($id);
        $agent->delete();
        if ($agent) {
          Session::flash('deleted', 'Agent Deleted!');
          return redirect('home/Agents');
        }
    }
}
