@extends('layouts.suadmin')

@section('su-title', 'Property Transaction Type')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}
.fa.fa-file-o {
  font-size: 30px;
}
tr{
  background: #fff;
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
@section('su-body')
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="col-md-12">
      @if (session('created'))
        <li class="alert alert-success">{{ session('created') }}</li>
      @endif
      @if (session('updated'))
        <li class="alert alert-success">{{ session('updated') }}</li>
      @endif
      @if (session('deleted'))
        <li class="alert alert-success">{{ session('deleted') }}</li>
      @endif
      <h3 class="text-center"> <i class="fa fa-exchange"></i> Transaction Types</h3>
      <div class="panel panel-default">
        <div class="panel-heading">Property Transaction Types</div>
        <div class="panel-body">
          <a href="#" role="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#transaction-type"><i class="fa fa-plus"></i> Add New</a>
          <br>
          <br>
          <div class="table table-responsive">
            <table class="table table-bordered">
              <tr>
                <th>#</th>
                <th>Transaction Type</th>
                <th>Action</th>
              </tr>
              @foreach($types as $type)
              <tr>
                <td>{{$type->id}}</td>
                <td>{{$type->name}}</td>
                <td>
                  <a href="{{ route('Transaction-type.edit', $type->id) }}" role="button" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> Edit</a> | <a href="{{ url('home/Transaction-type/destroy/'.$type->id) }}" role="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>

      <!-- Modal Starts -->
      <div id="transaction-type" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Property Transaction Type</h4>
            </div>
            <div class="modal-body">
              <form action="{{ route('Transaction-type.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="transaction_type" required />
                </div>
                  <button type="submit" class="btn btn-success">Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Ends -->
    </div><!-- /.col-md-12 -->
  </div>
</div>
@endsection
