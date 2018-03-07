@extends('layouts.suadmin')

@section('su-title', 'All Tasks')
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
      @if (session('updated'))
        <li class="alert alert-success">{{ session('updated') }}</li>
      @endif
      @if (session('deleted'))
        <li class="alert alert-success">{{ session('deleted') }}</li>
      @endif
      <a href="{{ route('Tasks.index') }}" type="button" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i> Back</a>
      <br>
      <br>
      <div class="table table-responsive">
        <table class="table table-bordered">
          <tr>
            <th>#</th>
            <th>Property Name</th>
            <th>Task</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          @foreach($tasks as $task)
          <tr>
            <td>{{$task->id}}</td>
            <td>{{ $task->property->property_title }}</td>
            <td>{{$task->task_name}}</td>
            <td>{{$task->task_day}}</td>
            <td>
              <a href="{{ route('Tasks.edit', $task->id) }}" type="button" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a>
            </td>
            <td>
              <form action="{{ route('Tasks.destroy', $task->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
