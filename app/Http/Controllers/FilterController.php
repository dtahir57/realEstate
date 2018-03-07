<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Property;
use App\User;
use Session;
class FilterController extends Controller
{
    public function __construct() {
      return $this->middleware('auth');
    }
    public function filter(Request $request) {
      if ($request->companies AND $request->agents) {
        $_agent = User::role('Agent')->where('name', $request->agents)->first();
        $c_ompany = Company::where('company_name', $request->companies)->first();
        $properties = Property::withTrashed()->where(['company_id' => $c_ompany->id, 'user_id' => $_agent->id])->get();
        $companies = Company::all();
        $agents = User::Role('Agent')->get();
        Session::flash('filtered', 'Showing Filtered Results');
        return view('Properties', compact('properties', 'companies', 'agents', 'c_ompany', '_agent'));
      }elseif($request->agents) {
          $_agent = User::role('Agent')->where('name', $request->agents)->first();
          $properties = Property::withTrashed()->where('user_id', $_agent->id)->get();
          $companies = Company::all();
          $agents = User::Role('Agent')->get();
          Session::flash('filtered', 'Showing Filtered Results');
          return view('Properties', compact('properties', 'companies', 'agents', '_agent'));

      }elseif($request->companies) {
          $c_ompany = Company::where('company_name', $request->companies)->first();
          $properties = Property::withTrashed()->where('company_id', $c_ompany->id)->get();
          $companies = Company::all();
          $agents = User::Role('Agent')->get();
          Session::flash('filtered', 'Showing Filtered Results');
          return view('Properties', compact('properties', 'companies', 'agents', 'c_ompany'));
      }elseif($request->status) {
          if ($request->status == 'approved') {
              $status = $request->status;
              $properties = Property::all();
              $companies = Company::all();
              $agents = User::Role('Agent')->get();
              Session::flash('filtered', 'Showing Filtered Results');
              return view('Properties', compact('properties', 'companies', 'agents', 'status'));
          } else {
            $status = $request->status;
            $properties = Property::onlyTrashed()->get();
            $companies = Company::all();
            $agents = User::Role('Agent')->get();
            Session::flash('filtered', 'Showing Filtered Results');
            return view('Properties', compact('properties', 'companies', 'agents', 'status'));
          }
      } else {
        return redirect()->back();
      }
    }
}
