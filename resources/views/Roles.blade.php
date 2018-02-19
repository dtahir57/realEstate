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
      @if(session('flash_msg'))
        <li class="alert alert-success">{{session('flash_msg')}}</li>
      @endif
      @if (session('del_flash'))
        <li class="alert alert-success">{{session('del_flash')}}</li>
      @endif
      <div class="panel panel-primary">
        <div class="panel-heading">All Roles</div>
        <div class="panel-body">
          <div class="panel-body">
            <a href="{{ route('roleCreate') }}" type="button" class="btn btn-success btn-lg pull-right">+ Add New</a>
            <br>
            <br>
            <br>
            <table class="table table-bordered">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
              @if(isset($roles))
                @foreach($roles as $r)
                <tr>
                  <td>{{$r->id}}</td>
                  <td>{{$r->name}}</td>
                  <td>
                    <a type="button" href="{{ URL::to('home/Roles/'.$r->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a> | <a type="button" href="{{ URL::to('home/Roles/show/'.$r->id) }}" class="btn btn-default btn-sm">View</a> | <a type="button" href="{{URL::to('home/Roles/'.$r->id)}}" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>
                @endforeach
              @endif
            </table>
          </div>
        </div>
      </div><!-- /.panel -->
    </div>
  </div>
</div>
@endsection
