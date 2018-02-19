@extends('layouts.user')

@section('title', 'Create')
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
      <div class="panel panel-primary">
        <div class="panel-heading">Permissions</div>
        <div class="panel-body">
          <a type="button" class="btn btn-warning btn-sm" href="{{route('permission')}}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
          <br>
          <br>
          <br>
          <form action="{{ route('storePermission') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="Name">Name</label>
              <input type="text" name="permission_name" class="form-control col-md-10" />
            </div>
            <br>
            <br>
            <input type="submit" class="btn btn-success btn-md pull-right" value="Create">
          </form>
        </div>
      </div><!-- /.panel.panel-primary -->
    </div>
  </div>
</div>
@endsection
