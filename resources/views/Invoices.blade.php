@extends('layouts.user')

@section('title', 'Invoices')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}
.fa.fa-file-o {
  font-size: 30px;
}
.fa.fa-pencil, .fa.fa-eye,.fa.fa-trash,.fa.fa-plus {
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
    <div class="col-md-12">
      @if(session('generated'))
        <li class="alert alert-success">{{ session('generated') }}</li>
      @endif
      <h3 class="text-center"> <i class="fa fa-address-book"></i> Invoices</h3>
      <div class="panel panel-default">
        <div class="panel-heading">Property Transaction Type</div>
        <div class="panel-body">
          <table class="table table-condensed">
            <tr>
              <th>#</th>
              <th>Property Title</th>
              <th>All Invoices</th>
            </tr>
            @foreach($properties as $property)
            <tr>
              <td>{{$property->id}}</td>
              <td>{{$property->property_title}}</td>
              <td>
                <a href="{{ route('Invoices.show', $property->id) }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Invoices</a>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div><!-- /.col-md-12 -->
  </div>
</div>
@endsection
