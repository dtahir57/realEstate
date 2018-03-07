@extends('layouts.suadmin')

@section('su-title', 'Edit Transaction')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}
#fa{
  font-size: 35px;
}
.table.table-bordered tr:nth-child(even){
  background: #fff;
}
@media screen and (max-width: 768px) {
  #page-wrapper {
    margin-left: 80px;
  }
  #fa{
    font-size: 25px;
  }
}
</style>
@section('su-body')
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Edit Transaction</div>
        <div class="panel-body">
          @foreach($errors->all() as $error)
            <li class="alert alert-danger">{{$error}}</li>
          @endforeach
          <form action="{{ route('Transactions.update', $transaction->id) }}" method="post">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Amount</label>
              <input type="number" class="form-control" name="amount" value="{{ $transaction->amount }}">
            </div>
            <div class="form-group">
              <label>Transaction Type</label>
              <select class="form-control" name="transaction_type">
                <option selected disabled>- SELECT -</option>
                @foreach($types as $type)
                <option value="{{$type->name}}" style="text-transform: capitalize">{{$type->name}}</option>
                @endforeach
              </select>
            </div>
            <input type="submit" class="btn btn-success" value="Update Transaction">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
