@extends('layouts.user')

@section('title', 'Manage Permissions')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
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
    <div class="col-md-10 col-md-offset-1 col-xs-12">
      @if(session('msg'))
        <li class="alert alert-success">{{session('msg')}}</li>
      @endif
      @if(session('del'))
        <li class="alert alert-success">{{session('del')}}</li>
      @endif
      <div class="panel panel-primary">
        <div class="panel-heading">Permissions</div>
        <div class="panel-body">
          <a href="{{route('permissionCreate')}}" type="button" class="btn btn-success btn-lg pull-right">+ Add New</a>
          <br>
          <br>
          <br>
          <table class="table table-bordered">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Actions</th>
            </tr>
            @if(isset($permission))
              @foreach($permission as $p)
              <tr>
                <td>{{$p->id}}</td>
                <td>{{$p->name}}</td>
                <td>
                  <a type="button" href="{{ URL::to('home/Permissions/'.$p->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a> | <a type="button" href="{{URL::to('home/Permissions/'.$p->id)}}" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              @endforeach
            @endif
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
