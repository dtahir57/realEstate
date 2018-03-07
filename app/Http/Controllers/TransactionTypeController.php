<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\PropertyTransactionType;
use Auth;
use Session;
use App\User;
class TransactionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct() {
       return $this->middleware('auth');
     }

    public function index()
    {
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $types = PropertyTransactionType::where('company_id', session('company_id'))->get();
          $user = User::where('company_id', session('company_id'))->first();
          return view('companies/Transaction-type', compact('types', 'user'));
        } else {
          $user = User::find(Auth::user()->id);
          $types = PropertyTransactionType::where('company_id', $user->company->id)->get();
          return view('Transaction-type', compact('types'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $user = User::where('company_id', session('company_id'))->first();
          $t_type = new PropertyTransactionType;
          $t_type->user_id = $user->id;
          $t_type->company_id = $user->company->id;
          $t_type->name = $request->transaction_type;
          $t_type->save();

          if ($t_type) {
            Session::flash('created', 'Transaction Type Created Successfully!');
            return redirect()->back();
          }
        }
        $user = User::find(auth::user()->id);
        $t_type = new PropertyTransactionType;
        $t_type->user_id = $user->id;
        $t_type->company_id = $user->company->id;
        $t_type->name = $request->transaction_type;
        $t_type->save();

        if ($t_type) {
          Session::flash('created', 'Transaction Type Created Successfully!');
          return redirect()->back();
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
        $types = PropertyTransactionType::where('company_id', $id)->get();
        return view('Transaction-type/details', compact('types'));
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
          $type = PropertyTransactionType::findOrFail($id);
          $user = User::where('company_id', session('company_id'))->first();
          return view('companies/Transaction-type/edit', compact('type', 'user'));
        }
        $type = PropertyTransactionType::findOrFail($id);
        return view('Transaction-type/edit', compact('type'));
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
        if (auth::user()->hasRole('superuser') AND session('company_id')) {
          $type = PropertyTransactionType::find($id);
          $type->name = $request->transaction_type;
          $type->update();
          if ($type) {
            $types = PropertyTransactionType::where('company_id', session('company_id'))->get();
            $user = User::where('company_id', session('company_id'))->first();
            Session::flash('updated', 'Transaction Type Name Updated Successfully!!!');
            return view('companies/Transaction-type', compact('types', 'user'));
          }
        }
        $type = PropertyTransactionType::find($id);
        $type->name = $request->transaction_type;
        $type->update();
        if ($type) {
          Session::flash('updated', 'Transaction Type Name Updated Successfully!!!');
          return redirect('home/Transaction-type');
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
          $type = PropertyTransactionType::findOrFail($id);
          $type->delete();

          if ($type) {
            Session::flash('deleted', 'Transaction Type Name Removed Successfully!!!');
            return redirect()->back();
          }
        }
        $type = PropertyTransactionType::findOrFail($id);
        $type->delete();

        if ($type) {
          Session::flash('deleted', 'Transaction Type Name Removed Successfully!!!');
          return redirect()->back();
        }
    }
}
