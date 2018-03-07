@extends('layouts.user')

@section('title', 'Manage All Properties')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}
.fa.fa-pencil, .fa.fa-eye,.fa.fa-trash, .fa.fa-check {
  font-size: 12px;
}
#fa{
  font-size: 35px;
}
.table.table-bordered tr{
  background: #fff;
}
td.images > img.img-responsive:not(:first-child) {
  display: none;
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
      <h2 class="text-center"><i class="fa fa-home" id="fa"></i> Manage All Properties</h2>
      @if (session('create_msg'))
        <li class="alert alert-success">{{session('create_msg')}}</li>
      @endif
      @if (session('updated'))
        <li class="alert alert-success">{{session('updated')}}</li>
      @endif
      @if (session('success'))
        <li class="alert alert-success">{{session('success')}}</li>
      @endif
      @if(session('restore_msg'))
        <li class="alert alert-success">{{session('restore_msg')}}</li>
      @endif
      @if(session('del_msg'))
        <li class="alert alert-success">{{session('del_msg')}}</li>
      @endif
      @hasrole('Agent')
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <form action="{{ route('filterProperty') }}" method="POST">
            {{ csrf_field() }}
            <div class="col-sm-6 form-group">
              <label>Approved / Un-Approved</label>
              <select class="form-control" name="status">
                <option selected disabled>- SELECT -</option>
                <option value="approved" @if(isset($status) AND $status == 'approved') selected @endif>Approved</option>
                <option value="unapproved" @if(isset($status) AND $status == 'unapproved') selected @endif>Un-Approved</option>
              </select>
            </div>
            <div class="col-sm-6" style="margin-top: 26px;">
              <input type="submit" class="btn btn-warning btn-block" value="Search">
            </div>
          </form>
        </div>
      </div><!-- /.row -->
      @endhasrole
      @hasrole('admin')
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <form action="{{ route('filterProperty') }}" method="POST">
            {{ csrf_field() }}
            <div class="col-sm-4 form-group">
              <label>Search By Agents</label>
              <select class="form-control" name="agents">
                <option selected disabled>- SELECT -</option>
                @if(isset($agents))
                @foreach($agents as $agent)
                <option value="{{$agent->name}}" @if(isset($_agent) AND $_agent->name == $agent->name) selected @endif>{{$agent->name}} - {{$agent->company->company_name}}</option>
                @endforeach
                @endif
              </select>
            </div>
            <div class="col-sm-4 form-group">
              <label>Approved / Un-Approved</label>
              <select class="form-control" name="status">
                <option selected disabled>- SELECT -</option>
                <option value="approved" @if(isset($status) AND $status == 'approved') selected @endif>Approved</option>
                <option value="unapproved" @if(isset($status) AND $status == 'unapproved') selected @endif>Un-Approved</option>
              </select>
            </div>
            <div class="col-sm-4" style="margin-top: 26px;">
              <input type="submit" class="btn btn-warning btn-block" value="Search">
            </div>
          </form>
        </div>
      </div><!-- /.row -->
      @endhasrole
      @hasrole('superuser')
      <div class="row">
        <form action="{{ route('filterProperty') }}" method="POST">
          {{ csrf_field() }}
          <div class="col-md-3 form-group">
            <label>Search By Companies</label>
            <select class="form-control" name="companies">
              <option selected disabled>- SELECT -</option>
              @if(isset($companies))
              @foreach($companies as $company)
              <option value="{{$company->company_name}}" @if(isset($c_ompany) AND $c_ompany->company_name == $company->company_name) selected @endif>{{$company->company_name}}</option>
              @endforeach
              @endif
            </select>
          </div>
          <div class="col-md-3 form-group">
            <label>Search By Agents</label>
            <select class="form-control" name="agents">
              <option selected disabled>- SELECT -</option>
              @if(isset($agents))
              @foreach($agents as $agent)
              <option value="{{$agent->name}}" @if(isset($_agent) AND $_agent->name == $agent->name) selected @endif>{{$agent->name}} - {{$agent->company->company_name}}</option>
              @endforeach
              @endif
            </select>
          </div>
          <div class="col-md-3 form-group">
            <label>Approved / Un-Approved</label>
            <select class="form-control" name="status">
              <option selected disabled>- SELECT -</option>
              <option value="approved" @if(isset($status) AND $status == 'approved') selected @endif>Approved</option>
              <option value="unapproved" @if(isset($status) AND $status == 'unapproved') selected @endif>Un-Approved</option>
            </select>
          </div>
          <div class="col-md-3" style="margin-top: 26px;">
            <input type="submit" class="btn btn-warning btn-block" value="Search">
          </div>
        </form>
      </div><!-- /.row -->
      @endhasrole
      @if (session('filtered'))
      <span class="text text-success">{{session('filtered')}}</span>
      @endif
      <div class="row">
        <div class="col-md-12 pull-right">
          <a href="{{ route('Properties.create') }}" type="button" class="btn btn-success pull-right">+ New Property</a>
        </div>
      </div>
      <br>
      <br>
      <div class="table table-responsive">
        <table class="table table-bordered">
          <tr>
            <th>Thumbnail</th>
            <th>Location</th>
            <th>Status</th>
            <th>Action</th>
            <th>Delete Permanently</th>
            <!-- <th>Delete</th> -->
          </tr>
          @foreach($properties as $property)
          <tr>
            <td class="images">
              @foreach($property->propertyHasImages as $image)
                <img src="{{url($image->img_url)}}" class="img-responsive" alt="Your Image" style="width: 120px; height: 100px;" />
              @endforeach
            </td>
            <td>{{$property->property_address}}</td>
            <td>
              @if ($property->deleted_at == null)
                <span class="text text-success">Approved</span>
                @else
                <span class="text text-danger">Unapproved</span>
              @endif
            </td>
            @if ($property->deleted_at == null)
            <td><a type="button" href="{{ url('home/Properties/'.$property->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a> | <a type="button" href="{{ url('home/Properties/'.$property->id) }}" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> Details</a> | <a href="{{ url('home/Properties/destroy/'.$property->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-trash"></i> Trash</a> </td>
              @else
            <td><a type="button" href="{{ url('home/Properties/restore/'.$property->id) }}" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Approve</a> </td>
            @endif
            <td><a type="button" href="{{ url('home/Properties/kill/'.$property->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a> </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
