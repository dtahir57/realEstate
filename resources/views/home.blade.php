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
          @if (auth::user()->can('Approve-property'))
            <button class="tablinks" onclick="openCity(event, 'Approve-property')">Drafts</button>
          @endif
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
        <h3>Approve-property</h3>
        <p>Approve-property Module</p>
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
