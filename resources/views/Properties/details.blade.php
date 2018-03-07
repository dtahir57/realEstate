@extends('layouts.user')

@section('title', 'Property Details')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 100px;
}
.fa.fa-pencil, .fa.fa-eye,.fa.fa-trash,.fa.fa-plus {
  font-size: 12px;
}
#fa{
  font-size: 35px;
}
.table.table-bordered tr:nth-child(even){
  background: #fff;
}
.panel-heading h2 {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  line-height: normal;
  width: 75%;
  padding-top: 8px;
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
      <a type="button" class="btn btn-warning btn-sm" href="{{ route('Properties.index') }}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
      <br>
      <!-- /.carousel starts -->
      @if($img_count == 0)
      <h4>No Images Uploaded For This Property Yet</h4>
      @else
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          @foreach($property->propertyHasImages as $image)
          <li data-target="#myCarousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
          @endforeach
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" id="add">
          @foreach($property->propertyHasImages as $image)
          <div class="item {{ $loop->first ? 'active' : '' }}">
            <img src="{{ url($image->img_url) }}" class="img-responsive" alt="Property">
          </div>
          @endforeach
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      @endif
      <!-- /.carousel ends -->
      <h2 style="text-transform: capitalize;"><i class="fa fa-building-o" id="fa"></i> Company Name: {{$c->company_name}}</h2>
      <br>
      <div class="table table-responsive">
        <table class="table table-bordered">
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Location</th>
          </tr>
          <tr>
            <td>{{$property->id}}</td>
            <td>{{$property->property_title}}</td>
            <td>{{$property->property_address}}</td>
          </tr>
        </table>
      </div>
    </div><!-- /.col-md-12 -->
  </div>
</div>
@endsection
