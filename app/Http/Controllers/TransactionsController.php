<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropertyTransaction;
use App\PropertyTransactionType;
use App\Property;
use Auth;
use Session;
use DB;
use App\User;
class TransactionsController extends Controller
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
        if (auth::user()->hasRole('admin')) {
          $user = User::find(auth::user()->id);
          $properties = Property::where('company_id', $user->company->id)->get();
          return view('Transactions', compact('properties'));
        } elseif(auth::user()->hasRole('superuser') AND session('company_id')) {
          $user = User::where('company_id', session('company_id'))->first();
          $properties = Property::where('company_id', session('company_id'))->get();
          return view('companies/Transactions', compact('properties', 'user'));
        } else {
          $properties = Property::all();
          return view('Transactions', compact('properties'));
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
          $user = User::find(auth::user()->id);
          $type = PropertyTransactionType::where(['company_id' => session('company_id'), 'name' => $request->transaction_type])->first();
          $transaction = new PropertyTransaction;
          $transaction->user_id = $user->id;
          $transaction->property_id = $request->property_id;
          $transaction->company_id = session('company_id');
          $transaction->property_transaction_type_id = $type->id;
          $transaction->amount = $request->amount;
          $transaction->amount_type = $request->transaction_type;
          $transaction->save();
          if ($transaction) {
            Session::flash('created', 'Transaction added Successfully');
            return $this->index();
          }
        }
        $user = User::find(auth::user()->id);
        $type = PropertyTransactionType::where(['company_id' => $user->company->id, 'name' => $request->transaction_type])->first();
        $transaction = new PropertyTransaction;
        $transaction->user_id = $user->id;
        $transaction->property_id = $request->property_id;
        $transaction->company_id = $user->company->id;
        $transaction->property_transaction_type_id = $type->id;
        $transaction->amount = $request->amount;
        $transaction->amount_type = $request->transaction_type;
        $transaction->save();
        if ($transaction) {
          Session::flash('created', 'Transaction added Successfully');
          return redirect('home/Transactions');
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
          $transactions = PropertyTransaction::where('property_id', $id)->get();
          $user = User::where('company_id', session('company_id'))->first();
          return view('companies/Transactions/details', compact('transactions', 'id', 'user'));
        }
        $transactions = PropertyTransaction::where('property_id', $id)->get();
        return view('Transactions/details', compact('transactions', 'id'));
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
          $transaction = PropertyTransaction::find($id);
          $types = PropertyTransactionType::where('company_id', session('company_id'))->get();
          $user = User::where('company_id', session('company_id'))->first();
          return view('companies/Transactions/edit', compact('transaction', 'types', 'user'));
        }
        $transaction = PropertyTransaction::find($id);
        $types = PropertyTransactionType::where('company_id', $transaction->company_id)->get();
        return view('Transactions/edit', compact('transaction', 'types'));
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
          $transaction = PropertyTransaction::find($id);
          $transaction->amount = $request->amount;
          $transaction->amount_type = $request->transaction_type;
          $transaction->update();
          if ($transaction) {
            Session::flash('updated', 'Transaction Updated Successfully!!!');
            return $this->index();
          }
        }
        $transaction = PropertyTransaction::find($id);
        $transaction->amount = $request->amount;
        $transaction->amount_type = $request->transaction_type;
        $transaction->update();
        if ($transaction) {
          Session::flash('updated', 'Transaction Updated Successfully!!!');
          return redirect('home/Transactions');
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
        //
    }

    public function newTransaction($id) {
      if (auth::user()->hasRole('superuser') AND session('company_id')) {
        $types = PropertyTransactionType::where('company_id', session('company_id'))->get();
        $user = User::where('company_id', session('company_id'))->first();
        return view('companies/Transactions/create', compact('types', 'id', 'user'));
      }
      $company = Property::findOrFail($id);
      $types = PropertyTransactionType::where('company_id', $company->company_id)->get();
      return view('Transactions/create', compact('types', 'id'));
    }
}
