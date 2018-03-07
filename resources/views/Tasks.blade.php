@extends('layouts.user')

@section('title', 'Tasks')
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
      <h3 class="text-center"> <i class="fa fa-file-o"></i> Tasks</h3>
      @if(session('created'))
        <li class="alert alert-success">{{ session('created') }}</li>
      @endif
      @if(session('updated'))
        <li class="alert alert-success">{{ session('updated') }}</li>
      @endif
      <div class="panel panel-default">
        <div class="panel-heading">Properties</div>
        <div class="panel-body">
          <div class="table table-responsive">
            <table class="table table-bordered">
              <tr>
                <th>Title</th>
                <th>Actions</th>
              </tr>
              @foreach($properties as $property)
              <tr>
                <td>{{$property->property_title}}</td>
                <td>
                  <a href="{{ url('home/Tasks/create/'.$property->id) }}" class="btn btn-success" type="button"><i class="fa fa-plus"></i> New Task</a> | <a href="{{ route('Tasks.show', $property->id) }}" type="button" class="btn btn-default"><i class="fa fa-eye"></i> All Tasks</a>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div><!-- /.col-md-12 -->
  </div>
</div>
@endsection
