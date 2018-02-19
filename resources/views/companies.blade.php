@extends('layouts.user')

@section('title', 'Manage User')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}
.table.table-bordered tr:nth-child(even){
  background: #fff;
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
      <h1>Companies Listing Page only viewable for superadmin</h1>
    </div>
  </div>
</div>
@endsection
