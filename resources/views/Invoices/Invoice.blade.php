@extends('layouts.user')

@section('title', 'Invoices')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}
.fa.fa-file-o {
  font-size: 30px;
}
tr{
  background: #fff;
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
  #fa{
    font-size: 25px;
  }
}
</style>
@section('body')
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="col-md-12">
      <a href="{{ route('Invoices.index') }}" type="button" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i> Back</a>
      <br>
      <br>
      @foreach($invoices as $invoice)
        <div class="panel panel-default">
          <div class="panel-heading">{{$invoice->property->property_title}}</div>
          <div class="panel-body">
            <table class="table table-condensed">
              <tr>
                <th>#</th>
                <th>Amount</th>
                <th>Type</th>
              </tr>
              @foreach($invoice->propertyTransactions as $t)
              <tr>
                <td>{{$t->id}}</td>
                <td>{{$t->amount}}</td>
                <td>{{$t->amount_type}}</td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
