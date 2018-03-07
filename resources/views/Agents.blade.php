@extends('layouts.user')

@section('title', 'Manage Agents')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}
.fa.fa-pencil, .fa.fa-eye,.fa.fa-trash {
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
    <div class="col-md-10 col-md-offset-1 col-xs-10">
      @if(session('success'))
        <li class="alert alert-success">{{session('success')}}</li>
      @endif
      @if(session('updated'))
        <li class="alert alert-success">{{session('updated')}}</li>
      @endif
      @if(session('deleted'))
        <li class="alert alert-success">{{session('deleted')}}</li>
      @endif
      <h1><i class="fa fa-user-o" id="fa"></i> Registered Agents</h1>
      <a href="{{ route('Agents.create') }}" type="button" class="btn btn-success pull-right">+ New Agent</a>
      <br>
      <br>
      <div class="table table-responsive">
        <table class="table table-bordered">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Edit / Details</th>
            <th>Delete</th>
          </tr>
          @foreach($agents as $agent)
          <tr>
            <td>{{$agent->id}}</td>
            <td>{{$agent->name}}</td>
            <td>{{$agent->email}}</td>
            <td><a type="button" href="{{ url('home/Agents/'.$agent->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a> | <a type="button" href="{{ route('Agents.show', $agent->id) }}" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> Details</a></td>
            <td>
              <form action="{{ route('Agents.destroy', $agent->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
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
