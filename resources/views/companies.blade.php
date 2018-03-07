@extends('layouts.user')

@section('title', 'Companies')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}
.table.table-bordered tr:nth-child(even){
  background: #fff;
}
.fa.fa-building-o {
  font-size: 30px;
}
.fa.fa-pencil, .fa.fa-eye,.fa.fa-trash {
  font-size: 12px;
}
tr {
  background-color: #fff;
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
    <div class="col-md-12">
      @if (session('company_id'))
      <h2>Company ID: {{session('company_id')}}</h2>
      @endif
      <h2><i class="fa fa-building-o"></i> Registered Companies</h2>
      <div class="table table-responsive">
        <table class="table table-bordered">
          <tr>
            <th>Name</th>
            <th class="pull-right">Delete</th>
          </tr>
          @foreach($companies as $company)
          <tr>
            <td><a href="{{ route('companies.show',$company->id) }}">{{$company->company_name}}</a></td>
            <td><a href="#" type="button" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash"></i> Delete</a> </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
