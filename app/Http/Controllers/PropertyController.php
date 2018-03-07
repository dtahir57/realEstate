<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\Http\Requests\PropertyRequest;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Company;
use App\User;
use Session;
use DB;
use App\PropertyHasImages;
use App\Task;
class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         return $this->middleware('auth');
     }
    public function index()
    {
        if (auth::user()->hasRole('superuser') AND Session::has('company_id')) {
          $properties = Property::where('company_id', session('company_id'))->get();
          $user = User::where('company_id', session('company_id'))->first();
          return view('companies/Properties', compact('properties', 'user'));
        }
        $id = Auth::user()->id;
        $user = User::find($id);
        //superuser can CRUD all properties
        if ($user->hasRole('superuser')) {
          $companies = Company::all();
          $agents = User::Role('Agent')->get();
          $properties = Property::withTrashed()->get();
           return view('Properties', compact('properties', 'companies', 'agents'));
        } elseif ($user->hasRole('admin')) {
          $properties = Property::where('company_id', $user->company_id)->get();
          return view('Properties', compact('properties'));
        }
        $properties = Property::where('user_id', $id)->get();
        return view('Properties', compact('properties'));
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
          return view('companies/Properties/create', compact('user'));
        }
        return view('Properties/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        if (auth::user()->hasRole('superuser') AND Session::has('company_id')) {
          $user = User::where('company_id', session('company_id'))->first();
          $property = new Property;
          $property->user_id = $user->id;
          $property->company_id = $user->company_id;
          $property->property_title = $request->property_title;
          $property->property_address = $request->property_address;
          $property->save();
          $property->delete();
          if ($property) {
            $user = User::where('company_id', session('company_id'))->first();
            $properties = Property::where('company_id', $user->company_id)->get();
            Session::flash('created', 'Property Created Successfully! Go to Draft to Approve it');
            return view('companies/Properties', compact('user', 'properties'));
          }
        }
        $userId = Auth::user()->id;
        $companyId = User::find($userId);
        $property = new Property;
        $property->user_id = $userId;
        $property->company_id = $companyId->company_id;
        $property->property_title = $request->property_title;
        $property->property_address = $request->property_address;
        $property->save();
        $property->delete();
        if ($property) {
          return redirect('home/Properties')->with('create_msg', 'Property Created Successfully. Go to draft to approve it!');
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
          $property = Property::find($id);
          $c = $property->company;
          $user = User::where('company_id', session('company_id'))->first();
          return view('companies/Properties/details', compact('property', 'c', 'user'));
        }
        $property = Property::find($id);
        $c = $property->company;
        $imgs = PropertyHasImages::where('property_id', $id)->get();
        $img_count = count($imgs);
        $tasks = Task::where(['property_id' => $id, 'user_id' => Auth::user()->id])->get();
        return view('Properties/details', compact('property', 'c', 'img_count', 'tasks'));
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
          $property = Property::find($id);
          $user = User::where('company_id', session('company_id'))->first();
          return view('companies/Properties/edit', compact('property', 'user'));
        }
        $property = Property::find($id);
        if ($property->propertyHasImages == null) {
          return view('Properties/edit', compact('property'));
        } else {
          $images = PropertyHasImages::where('property_id', $id)->get();
          return view('Properties/edit', compact('property', 'images'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, $id)
    {
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $user = DB::table('users')->where('company_id', session('company_id'))->first();
          $property = Property::find($id);
          $property->user_id = $user->id;
          $property->company_id = session('company_id');
          $property->property_title = $request->property_title;
          $property->property_address = $request->property_address;
          $property->save();
          if ($property) {
            Session::flash('updated', 'Property Details Updated');
            $properties = Property::where('company_id', session('company_id'))->get();
            return view('companies/Properties', compact('user', 'properties'));
          }
        }
          $userId = Auth::user()->id;
          $companyId = User::find($userId);
          $property = Property::find($id);
          $property->user_id = $userId;
          $property->company_id = $companyId->company_id;
          $property->property_title = $request->property_title;
          $property->property_address = $request->property_address;
          $property->save();
          $images = $request->file('images');
          if ($request->hasFile('images')) {
            foreach($images as $image) {
              $image->move('uploads', $image->getClientOriginalName());
              $property_has_images = new PropertyHasImages;
              $property_has_images->property_id = $property->id;
              $property_has_images->img_url = 'uploads/' . $image->getClientOriginalName();
              $property_has_images->save();
            }
          }
          if ($property) {
            Session::flash('updated', 'Property Details Updated');
            return redirect('home/Properties');
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
        $del = Property::find($id);
        $del->delete();
        if ($del){
          Session::flash('del_msg', 'Property Record trashed Successfully!');
          return redirect('home/Properties');
        }
    }

    public function restore($id) {
      $property = Property::withTrashed()->where('id', $id)->first();
      $property->restore();
      Session::flash('restore_msg', 'Property Approved!');
      return redirect('home/Properties');
    }

    public function kill($id) {
      $property = Property::withTrashed()->where('id', $id)->first();
      $property->forceDelete();
      Session::flash('success', 'Property Deleted Permanently!');
      return redirect()->back();
    }
}
