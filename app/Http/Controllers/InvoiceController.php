<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\Invoice;
use Auth;
use Session;
use App\PropertyTransaction;
use App\User;
class InvoiceController extends Controller
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
          return view('Invoices', compact('properties'));
        } elseif (auth::user()->hasRole('superuser') AND session('company_id')) {
          $user = User::where('company_id', session('company_id'))->first();
          $properties = Property::where('company_id', session('company_id'))->get();
          return view('companies/Invoices', compact('properties', 'user'));
        } else {
          $properties = Property::where('user_id', Auth::user()->id)->get();
          return view('Invoices', compact('properties'));
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
        $company = Property::where('id', $request->property_id)->first();
        $invoice = New Invoice;
        $invoice->user_id = Auth::user()->id;
        $invoice->company_id = $company->company_id;
        $invoice->property_id = $request->property_id;
        $invoice->save();
        foreach($request->transactions as $t) {
          $transaction = PropertyTransaction::findOrFail($t);
          if ($transaction->invoice_id == null) {
            $transaction->invoice_id = $invoice->id;
            $transaction->update();
          } else {
            $trans_new = new PropertyTransaction;
            $trans_new->user_id = Auth::user()->id;
            $trans_new->property_id = $request->property_id;
            $trans_new->company_id = $company->company_id;
            $trans_new->invoice_id = $invoice->id;
            $trans_new->property_transaction_type_id = $transaction->property_transaction_type_id;
            $trans_new->amount = $transaction->amount;
            $trans_new->amount_type = $transaction->amount_type;
            $trans_new->save();
          }
        }
        if ($invoice) {
          Session::flash('generated', 'Invoice Created Successfully!!!');
          return redirect('home/Invoices');
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
        $invoices = Invoice::where('property_id', $id)->get();
        return view('Invoices/Invoice', compact('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
