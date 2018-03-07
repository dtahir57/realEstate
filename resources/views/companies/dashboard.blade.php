@extends('layouts.suadmin')

@section('su-title', 'User Dashboard')
<style media="screen">
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
@section('su-body')
<div id="page-wrapper">
  <div class="container-fluid">
    <h1>{{session('company_id')}}</h1>
  </div>
</div>
@endsection
