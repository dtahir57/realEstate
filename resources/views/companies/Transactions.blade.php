@extends('layouts.suadmin')

@section('su-title', 'Transactions')
<style media="screen">
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
.fa.fa-pencil, .fa.fa-eye,.fa.fa-trash,.fa.fa-plus, .fa.fa-times {
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
@section('su-body')
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="col-md-12">
      <h3 class="text-center"> <i class="fa fa-dollar"></i> Transactions</h3>
      @if (session('created'))
        <li class="alert alert-success">{{ session('created') }}</li>
      @endif
      @if (session('updated'))
        <li class="alert alert-success">{{ session('updated') }}</li>
      @endif
      <div class="panel panel-default">
        <div class="panel-heading">Add Transactions</div>
        <div class="panel-body">
          <table class="table table-condensed">
            <tr>
              <th>Property Name</th>
              <th>Action</th>
            </tr>
            @foreach($properties as $property)
            <tr>
              <td>{{$property->property_title}}</td>
              <td>
                <a href="{{ url('home/Transactions/create/'.$property->id) }}" type="button" class="btn btn-default btn-xs"><i class="fa fa-plus"></i> New</a> | <a href="{{ route('Transactions.show', $property->id) }}" role="button" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Details</a>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
