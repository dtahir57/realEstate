@extends('layouts.suadmin')

@section('su-title', 'Edit')
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
    <div class="col-md-10 col-md-offset-1 col-xs-10">
      <div class="panel panel-default">
        <div class="panel-heading">Edit</div>
        <div class="panel-body">
          <h2><i class="fa fa-home" id="fa"></i> Edit {{$property->property_title}}'s Details</h2>
          <a type="button" class="btn btn-warning btn-sm" href="{{ route('Properties.index') }}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
          <br>
          <br>
          <form action="{{ route('Properties.update', $property->id) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label>Property Title</label>
              <input type="text" class="form-control" name="property_title" value="{{ $property->property_title }}">
            </div>
            <div class="form-group">
              <label>Property Address</label>
              <input type="text" class="form-control" name="property_address" value="{{ $property->property_address}}">
            </div>
            <input type="submit" class="btn btn-success" value="Update">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
