@extends('layouts.user')

@section('title', 'Edit')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}
#fa{
  font-size: 35px;
}
li#images {
  list-style-type: none;
  float: right;
  padding: 20px;
}
.table.table-bordered tr:nth-child(even){
  background: #fff;
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
      <div class="panel panel-default">
        <div class="panel-heading">Edit</div>
        <div class="panel-body">
          <h2><i class="fa fa-home" id="fa"></i> Edit {{$property->property_title}}'s Details</h2>
          <a type="button" class="btn btn-warning btn-sm" href="{{ route('Properties.index') }}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
          <br>
          <br>
          <form action="{{ route('Properties.update', $property->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label>Property Title</label>
              <input type="text" class="form-control" name="property_title" value="{{ $property->property_title }}">
            </div>
            <div class="form-group">
              <label>Property Address</label>
              <input type="text" class="form-control" name="property_address" value="{{ $property->property_address}}">
            </div>
            <div class="form-group">
              <label>Images</label>
              <input type="file" name="images[]" class="form-control" multiple />
              <small>Please select atleast two images</small>
            </div>
            <input type="submit" class="btn btn-success" value="Update">
            @if (isset($images))
            <h4>Recently Uploaded Files</h4>
            @foreach($images as $image)
              <li id='images'><img src="{{url($image->img_url)}}" class="img-responsive" style="width: 200px; height: 200px;" alt=""> </li>
            @endforeach
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<script type="text/javascript">
function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#blah')
                      .attr('src', e.target.result)
                      .width(150)
                      .height(200);
              };

              reader.readAsDataURL(input.files[0]);
          }
      }
</script>
