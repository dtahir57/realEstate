@extends('layouts.user')

@section('title', 'Manage User')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}
.table.table-bordered tr:nth-child(even){
  background: #fff;
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
    <div class="col-md-10 col-md-offset-1 col-xs-10">
      @if (session('update'))
        <li class="alert alert-success">{{session('update')}}</li>
      @endif
      @if (session('succ_msg'))
        <li class="alert alert-success">{{session('succ_msg')}}</li>
      @endif
      <div class="panel panel-primary">
        <div class="panel-heading">All Users</div>
        <div class="panel-body">
          <a href="{{ route('createUser') }}" type="button" class="btn btn-success btn-sm pull-right">+ Create A New User</a>
          <h2><i class="fa fa-users" style="font-size: 35px;"></i> User Administration</h2>
          <div class="table table-responsive">
            <table class="table table-bordered">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
              </tr>
              @foreach($users as $user)
              <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->getRoleNames()[0]}}</td>
                <td>
                  <a href="{{URL::to('home/user/'.$user->id.'/edit')}}" class="btn btn-primary btn-sm" type="button">Edit</a> | <a href="{{URL::to('home/user/show/'.$user->id)}}" type="button" class="btn btn-default btn-sm">View</a> | <a href="{{URL::to('home/user/'.$user->id)}}" type="button" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
