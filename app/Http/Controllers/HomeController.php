<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Auth;
use App\User;
use App\Property;
use Session;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $id= Auth::user()->id;
          $user = User::find($id);
          $roles = $user->getRoleNames();
          if (auth::user()->can('Approve-property') AND auth::user()->hasRole('admin') OR auth::user()->hasRole('Agent')) {
            $properties = Property::onlyTrashed()->where('company_id', $user->company_id)->get();
            return view('home', compact('roles', 'properties'));
          }
          else {
            $properties = Property::onlyTrashed()->get();
            return view('home', compact('roles', 'properties'));
          }
    }
    public function restore($id) {
      $property = Property::withTrashed()->where('id', $id)->first();
      $property->restore();
      Session::flash('restore_msg', 'Property Approved!');
      return redirect()->back();
    }
}
