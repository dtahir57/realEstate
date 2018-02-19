@extends('layouts.user')

@section('title', 'Manage User')
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
    <div class="col-md-10 col-md-offset-1 col-xs-10">
      <div class="panel panel-primary">
        <div class="panel-heading">{{$user->name}}'s Information</div>
        <div class="panel-body">
          <a type="button" class="btn btn-warning btn-sm" href="{{route('showUsers')}}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
          <br>
          <br>
          <br>
          <table class="table table-condensed">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Roles</th>
            </tr>
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>
                <ol>
                  @foreach($roles as $role)
                  <li>{{$role}}</li>
                  @endforeach
                </ol>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
