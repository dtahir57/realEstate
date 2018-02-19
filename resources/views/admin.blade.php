@extends('layouts.admin-layout')

@section('admin-title', 'Dashboard')
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
@section('admin-body')
  <div id="page-wrapper">
    <br>
    <br>
    
    <div class="col-md-10 col-md-offset-1 col-sm-10 col-xs-12">
      <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'drafts')">Drafts</button>
        <button class="tablinks" onclick="openCity(event, 'Transactions')">Transactions</button>
        <button class="tablinks" onclick="openCity(event, 'Invoices')">Invoices</button>
        <button class="tablinks" onclick="openCity(event, 'Task')">Task</button>
      </div>

      <div id="drafts" class="tabcontent">
        <h3>Drafts</h3>
        <p>Drafts Module</p>
      </div>

      <div id="Transactions" class="tabcontent">
        <h3>Transactions</h3>
        <p>Transactions Module</p>
      </div>

      <div id="Invoices" class="tabcontent">
        <h3>Invoices</h3>
        <p>Invoices Module</p>
      </div>
      <div id="Task" class="tabcontent">
        <h3>Task Alert</h3>
        <p>Task Alert ModuleS</p>
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
