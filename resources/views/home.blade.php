@extends('layouts.user')

@section('title', 'User Dashboard')
<style media="screen" scoped>
#page-wrapper {
  margin-left: 200px;
  margin-top: 80px;
}
/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
@media screen and (max-width: 768px) {
  #page-wrapper {
    margin-left: 80px;
  }
}
</style>
@section('body')
  <div id="page-wrapper">
    <br>
    <br>
    <div class="col-md-10 col-md-offset-1 col-sm-10 col-xs-12">
      @foreach($roles as $role)
      <h4 style="color: green;">Role: <span style="text-transform: capitalize;">{{$role}}</span> </h4>
      @endforeach
      <h4>Below are the permission name(s) assigned for this or these role(s)</h4>
      <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'Approve-property')">Drafts</button>
          @if(auth::user()->can('Task-transactions-own'))
            <button class="tablinks" onclick="openCity(event, 'Task-transactions-own')">Transcations</button>
          @endif
          @if(auth::user()->can('Task-transactions-all'))
            <button class="tablinks" onclick="openCity(event, 'Task-transactions-all')">Task</button>
          @endif
          @if(auth::user()->can('Invoice-property'))
              <button class="tablinks" onclick="openCity(event, 'Invoice-property')">Invoice</button>
          @endif
      </div>

      <div id="Approve-property" class="tabcontent">
        @if (session('restore_msg'))
          <li class="alert alert-success">{{session('restore_msg')}}</li>
        @endif
        <h3>Approve properties</h3>
        <div class="table table-responsive">
          <table class="table table-bordered">
            <tr>
              <th>#</th>
              <th>Property Name</th>
              <th>Property Address</th>
              @if (auth::user()->can('Approve-property'))
              <th>Approve</th>
              @endif
            </tr>
            @foreach($properties as $property)
            <tr>
              <td>{{$property->id}}</td>
              <td>{{$property->property_title}}</td>
              <td>{{$property->property_address}}</td>
              @if (auth::user()->can('Approve-property'))
              <td><a type="button" href="{{ url('home/'.$property->id) }}" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve</a> </td>
              @endif
            </tr>
            @endforeach
          </table>
        </div>
      </div>

      <div id="Task-transactions-all" class="tabcontent">
        <h3>Task-transactions-all</h3>
        <p>Task-transactions-all Module</p>
      </div>

      <div id="Task-transactions-own" class="tabcontent">
        <h3>Task-transactions-own</h3>
        <p>Task-transactions-own Module</p>
      </div>

      <div id="Invoice-property" class="tabcontent">
        <h3>Invoice-property</h3>
        <p>Invoice-property Module</p>
      </div>

    </div>
  </div>
@endsection
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
