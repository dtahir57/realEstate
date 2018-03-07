@extends('layouts.user')

@section('title', 'New Transaction')
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
@section('body')
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="col-md-12">
      <a type="button" class="btn btn-warning btn-sm" href="{{ route('Transactions.index') }}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
      <br>
      <br>
      <div class="panel panel-default">
        <div class="panel-heading">New Transaction</div>
        <div class="panel-body">
          @foreach($errors->all() as $error)
            <li class="alert alert-danger">{{$error}}</li>
          @endforeach
          <form action="{{ route('Transactions.store') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="property_id" value="{{$id}}">
            <div class="form-group">
              <label>Amount</label>
              <input type="number" class="form-control" name="amount" value="{{ old('amount') }}">
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
            <input type="submit" class="btn btn-success" value="Create Transaction">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
