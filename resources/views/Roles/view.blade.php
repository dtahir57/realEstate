@extends('layouts.user')

@section('title', 'Manage Roles')
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
        <div class="panel-heading">All Roles</div>
        <div class="panel-body">
          <div class="panel-body">
            <a type="button" class="btn btn-warning btn-sm" href="{{route('roles')}}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
            <br>
            <br>
            <br>
            <table class="table table-condensed">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Guard</th>
                <th>Permissions</th>
              </tr>
                <tr>
                  <td>{{$singleRecord->id}}</td>
                  <td>{{$singleRecord->name}}</td>
                  <td>{{$singleRecord->guard_name}}</td>
                  <td>
                    <ol>
                    @foreach($singleRecord->permissions as $p)
                      <li>{{$p->name}}</li>
                    @endforeach
                    </ol>
                  </td>
                </tr>
            </table>
          </div>
        </div>
      </div><!-- /.panel -->
    </div>
  </div>
</div>
@endsection
