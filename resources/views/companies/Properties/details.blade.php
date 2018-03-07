@extends('layouts.suadmin')

@section('su-title', 'Property Details')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}
.fa.fa-pencil, .fa.fa-eye,.fa.fa-trash {
  font-size: 12px;
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
    <div class="col-md-10 col-md-offset-1 col-xs-10">
      <h2 style="text-transform: capitalize;"><i class="fa fa-building-o" id="fa"></i> Company Name: {{$c->company_name}}</h2>
      <a type="button" class="btn btn-warning btn-sm" href="{{ route('Properties.index') }}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
      <br>
      <br>
      <div class="table table-responsive">
        <table class="table table-bordered">
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Address</th>
          </tr>
          <tr>
            <td>{{$property->id}}</td>
            <td>{{$property->property_title}}</td>
            <td>{{$property->property_address}}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
