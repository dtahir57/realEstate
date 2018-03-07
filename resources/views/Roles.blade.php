@extends('layouts.user')

@section('title', 'Manage Roles')
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
      <h2 class="text-center"><i class="fa fa-user-circle-o"></i> Manage Roles</h2>
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
            <a href="{{ route('Roles.create') }}" type="button" class="btn btn-success btn-lg pull-right">+ Add New</a>
            <br>
            <br>
            <br>
            <table class="table table-bordered">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Edit/View</th>
                <th>Delete</th>
              </tr>
              @if(isset($roles))
                @foreach($roles as $r)
                <tr>
                  <td>{{$r->id}}</td>
                  <td>{{$r->name}}</td>
                  <td>
                    <a type="button" href="{{ url('home/Roles/'.$r->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a> | <a type="button" href="{{ url('home/Roles/'.$r->id) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> View</a>
                  </td>
                  <td>
                    <form action="{{ route('Roles.destroy', $r->id) }}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                    </form>
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
