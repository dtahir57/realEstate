@extends('layouts.user')

@section('title', 'Manage Permissions')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}
.fa.fa-pencil, .fa.fa-eye,.fa.fa-trash {
  font-size: 12px;
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
      <h2 class="text-center"><i class="fa fa-user-plus"></i> Manage Permissions</h2>
      @if(session('msg'))
        <li class="alert alert-success">{{session('msg')}}</li>
      @endif
      @if(session('del'))
        <li class="alert alert-success">{{session('del')}}</li>
      @endif
      @if(session('sucess_message'))
        <li class="alert alert-success">{{session('sucess_message')}}</li>
      @endif
      <div class="panel panel-primary">
        <div class="panel-heading">Permissions</div>
        <div class="panel-body">
          <a href="{{ url('home/Permissions/create') }}" type="button" class="btn btn-success btn-lg pull-right">+ Add New</a>
          <br>
          <br>
          <br>
          <div class="table table-responsive">
            <table class="table table-bordered">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
              @if(isset($permission))
                @foreach($permission as $p)
                <tr>
                  <td>{{$p->id}}</td>
                  <td>{{$p->name}}</td>
                  <td><a type="button" href="{{ url('home/Permissions/'.$p->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a></td>
                  <td>
                    <form action="{{ route('Permissions.destroy', $p->id) }}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
                    </form>
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
</div>
@endsection
