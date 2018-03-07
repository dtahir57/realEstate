@extends('layouts.user')

@section('title', 'Manage Agents')
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
    <div class="col-md-10 col-md-offset-1 col-xs-10">
      <h1><i class="fa fa-user-o" id="fa"></i> {{$agent->name}}'s Details</h1>
      <a type="button" class="btn btn-warning btn-sm" href="{{ route('Agents.index') }}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
      <br>
      <br>
      <div class="table table-responsive">
        <table class="table table-bordered">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Permissions</th>
          </tr>
          <tr>
            <td>{{$agent->id}}</td>
            <td>{{$agent->name}}</td>
            <td>{{$agent->email}}</td>
            <td>
              <ol>
                @foreach($agent->permissions as $permission)
                  <li>{{$permission->name}}</li>
                @endforeach
              </ol>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
