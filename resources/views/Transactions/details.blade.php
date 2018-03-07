@extends('layouts.user')

@section('title', 'Transactions Details')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}

.fa.fa-pencil, .fa.fa-eye,.fa.fa-trash,.fa.fa-plus {
  font-size: 12px;
}
#fa{
  font-size: 35px;
}
@media screen and (max-width: 768px) {
  #page-wrapper {
    margin-left: 80px;
  }
}
</style>
@section('body')
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Transactions</div>
        <div class="panel-body">
          <a type="button" class="btn btn-warning btn-sm" href="{{ route('Transactions.index') }}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
          <br>
          <br>
          <table class="table table-condensed">
            <tr>
              <th>Amount</th>
              <th>Transaction Type</th>
              <th>Action</th>
            </tr>
            @foreach($transactions as $transaction)
            <tr>
              <td>{{$transaction->amount}}</td>
              <td>{{$transaction->amount_type}}</td>
              <td>
                <a href="{{ route('Transactions.edit', $transaction->id) }}" role="button" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> Edit</a> | <a href="#" role="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
              </td>
            </tr>
            @endforeach
          </table>
          <hr>
          <h4 class="text-center">Create Invoice</h4>
          <form action="{{ route('Invoices.store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Transactions: </label>
                @foreach($transactions as $transaction)
                <input type="checkbox" name="transactions[]" value="{{$transaction->id}}"> {{$transaction->amount}} - {{$transaction->amount_type}} 
                @endforeach
            </div>
            <input type="hidden" name="property_id" value="{{ $id }}">
            <input type="submit" class="btn btn-success" value="Create Invoice">
          </form>
        </div><!-- /.panel-body -->
      </div><!-- /.panel -->
    </div>
  </div>
</div>
@endsection
