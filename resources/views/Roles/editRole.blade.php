@extends('layouts.user')

@section('title', 'Edit Role')
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
        <div class="panel-heading">Edit Role</div>
        <div class="panel-body">
          <a type="button" class="btn btn-warning btn-sm" href="{{ route('Roles.index') }}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
          <br>
          <br>
          <br>
          <form action="{{ route('Roles.update', $role->id) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="Name">Name</label>
              <input type="text" name="name" class="form-control col-md-10" value="{{$role->name}}" required />
            </div>
            <div class="form-group">
              <label>Permissions</label>
              <select multiple class="form-control" name="permissions[]" required>
                <option value="Approve-property">Approve-property</option>
                <option value="Task-transactions-all">Task-transactions-all</option>
                <option value="Invoice-property">Invoice-property</option>
              </select>
            </div>
            <input type="hidden" name="_method" value="PUT">
            <p>Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</p>
            <br>
            <input type="submit" class="btn btn-success btn-md pull-right" value="Update">
          </form>
        </div>
      </div><!-- /.panel.panel-primary -->
    </div>
  </div>
</div>
@endsection
