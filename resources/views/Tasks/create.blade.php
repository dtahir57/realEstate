@extends('layouts.user')

@section('title', 'New Task')
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
    <div class="col-md-8 col-md-offset-2">
      <h1 class="text-center"><i class="fa fa-file-o"></i> New Task</h1>
      <form action="{{ route('Tasks.store') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <label>Task Name</label>
          <input type="text" name="task_name" class="form-control" value="{{ old('task_name') }}">
        </div>
        <div class="form-group">
          <label>Date</label>
          <input type="date" class="form-control" name="task_day" value="{{ old('task_day') }}">
        </div>
        <input type="submit" class="btn btn-success btn-block" value="Create" />
      </form>
    </div><!-- /.col-md-12 -->
  </div>
</div>
@endsection
</script>
