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
    <div class="col-md-10 col-md-offset-1 col-xs-12">
      @foreach($errors->all() as $error)
        <li class="alert alert-danger">{{$error}}</li>
      @endforeach
      <div class="panel panel-default">
        <div class="panel-heading">Create A User</div>
        <div class="panel-body">
          <a type="button" class="btn btn-warning btn-sm" href="{{route('showUsers')}}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
          <br>
          <br>
          <br>
          <form action="{{ route('storeUser') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="Name">Name</label>
              <input type="text" name="name" class="form-control" value="{{old('name')}}" />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control" value="{{old('email')}}" />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" value="{{old('password')}}" />
            </div>
            <div class="form-group">
              <label for="roles">Assign Roles</label>
              <select multiple class="form-control" name="roles[]" required>
                @foreach($roles as $role)
                <option value="{{$role->name}}">{{$role->name}}</option>
                @endforeach
              </select>
              <p>Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</p>
            </div>
            <input type="submit" class="btn btn-success btn-md pull-right" value="Create" />
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
