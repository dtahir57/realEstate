@extends('layouts.user')

@section('title', 'Edit')
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
.fa.fa-pencil, .fa.fa-eye,.fa.fa-trash,.fa.fa-plus, .fa.fa-times {
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
      <a href="{{ route('Transaction-type.index') }}" role="button" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i> Back</a>
      <br>
      <br>
      <form action="{{ route('Transaction-type.update', $type->id) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" name="transaction_type" value="{{ $type->name }}">
        </div>
        <input type="submit" class="btn btn-success" value="Save Changes">
      </form>
    </div>
  </div>
</div>
@endsection
