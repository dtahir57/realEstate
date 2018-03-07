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
      <div class="panel panel-default">
        @foreach($errors->all() as $error)
          <li class="alert alert-danger">{{$error}}</li>
        @endforeach
        <div class="panel-heading">New Agent</div>
        <div class="panel-body">
          <h3>Create New</h3>
          <a type="button" class="btn btn-warning btn-sm" href="{{ route('Agents.index') }}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
          <br>
          <br>
          <form action="{{ route('Agents.store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{old('name')}}" />
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="email" value="{{old('email')}}">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" value="{{old('password')}}">
            </div>
            <div class="form-group">
              <label>Property Permission: </label>
              <select multiple class="form-control" name="property[]">
                <option value="Approve-property">Approve-property</option>
                <option value="Invoice-property">Invoice-property</option>
              </select>
            </div>
            <p>Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</p>
            <div class="form-group">
              <label>Transaction Permission: </label>
              <input type="radio" name="transaction" value="Task-transactions-own" /> Task-transactions-own
              <input type="radio" name="transaction" value="Task-transactions-all" /> Task-transactions-all
            </div>
            <input type="submit" class="btn btn-success" value="+ Create Agent" />
          </form>
        </div>
      </div><!-- /.panel.panel-primary -->
    </div>
  </div>
</div>
@endsection
