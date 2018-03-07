@extends('layouts.user')

@section('title', 'Transaction Types')
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
@section('body')
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="col-md-12">
      @if (session('deleted'))
        <li class="alert alert-success">{{ session('deleted') }}</li>
      @endif
      <a href="{{ route('Transaction-type.index') }}" type="button" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i> Back</a>
      <br>
      <br>
      @foreach($types as $type)
        <div class="panel panel-default">
          <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">{{ $type->company->company_name }}</h4>
              <div class="btn-group pull-right">
                <a href="{{ route('Transaction-type.edit', $type->id) }}" type="button" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                <a href="{{ url('home/Transaction-type/destroy/'.$type->id) }}" type="button" class="btn btn-danger"><i class="fa fa-times"></i> Delete</a>
              </div>
            </div>
          <div class="panel-body">
            <div class="col-md-6 col-sm-6">
              <h3>Transaction Type Name</h3>
            </div>
            <div class="col-md-6 col-sm-6">
              <h3 class="pull-right">{{$type->name}}</h3>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
