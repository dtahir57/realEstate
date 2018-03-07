@extends('layouts.suadmin')

@section('su-title', 'Manage All Properties')
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
      @if (session('created'))
        <li class="alert alert-success">{{session('created')}}</li>
      @endif
      @if (session('updated'))
        <li class="alert alert-success">{{session('updated')}}</li>
      @endif
      @if (session('success'))
        <li class="alert alert-success">{{session('success')}}</li>
      @endif
      <h2><i class="fa fa-home" id="fa"></i> Manage All Properties</h2>
      <div class="row">
        <div class="col-md-12 pull-right">
          <a href="{{ route('Properties.create') }}" type="button" class="btn btn-success pull-right">+ New Property</a>
        </div>
      </div>
      <br>
      <br>
      <div class="table table-responsive">
        <table class="table table-bordered">
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Address</th>
            <th>Edit / Details</th>
            <th>Delete Permanently</th>
            <!-- <th>Delete</th> -->
          </tr>
          @foreach($properties as $property)
          <tr>
            <td>{{$property->id}}</td>
            <td>{{$property->property_title}}</td>
            <td>{{$property->property_address}}</td>
            <td><a type="button" href="{{ url('home/Properties/'.$property->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a> | <a type="button" href="{{ url('home/Properties/'.$property->id) }}" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> Details</a></td>
            <td><a type="button" href="{{ url('home/Properties/kill/'.$property->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a> </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
