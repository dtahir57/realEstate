<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-custom-styles.css')}}">
    <link rel="stylesheet" href="{{ asset('css/fa/css/font-awesome.min.css')}}">
</head>
  <body>
    <div id="app">
      <div id="top-menu">
        <div id="navigation-items">
            <div class="col-md-8 col-sm-8 col-xs-12">
              <ul id="nav-icons">
                <li><a href="#"><i class="fa fa-user-o" aria-hidden="true"></i></a> </li>
                <li><a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i> </a> </li>
                <li><a href="#"><i class="fa fa-bell-o"></i> </a> </li>
              </ul>
            </div>
            <div class="col-md-4 col-sm-4 hidden-xs">
              <div class="input-group hidden-xs">
                <input type="text" id="top-search" class="form-control input-sm" placeholder="Search" name="search">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
              </div><!-- /.input-group -->
            </div><!-- /.col-md-4.col-sm-4.hidden-xs -->
        </div><!-- /#navigation-items -->
      </div>
      <div id="sidebar">
        <div id="heading">
          <h4>{{ Auth::user()->name }}</h4>
        </div>
        <div id="side-menu">
          <ul>
            <li>
              <a href="{{ route('home') }}">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                <span>Dashboard</span>
              </a>
            </li>
            @hasrole('superuser')
            <li>
              <a href="{{ url('home/Permissions') }}">
                <i class="fa fa-user-plus"></i>
                <span>Permissions</span>
              </a>
            </li>
            <li>
              <a href="{{ route('Roles.index') }}">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                <span>Roles</span>
              </a>
            </li>
            <li>
              <a href="{{ route('companies.index') }}">
                <i class="fa fa-building"></i>
                <span>Companies</span>
              </a>
            </li>
            @endhasrole
            <li>
              <a href="{{ route('Properties.index') }}">
                <i class="fa fa-home" aria-hidden="true"></i>
                <span>Properties</span>
              </a>
            </li>
            @hasrole('admin')
            <li>
              <a href="{{ route('Agents.index') }}">
                <i class="fa fa-user-o" aria-hidden="true"></i>
                <span>Agents</span>
              </a>
            </li>
            @endhasrole
            <li>
              <a href="{{ route('Tasks.index') }}">
                <i class="fa fa-file" aria-hidden="true"></i>
                <span>Tasks</span>
              </a>
            </li>
            @hasrole('admin')
            <li>
              <a href="{{ route('Transaction-type.index') }}">
                <i class="fa fa-exchange" aria-hidden="true"></i>
                <span>Types</span>
              </a>
            </li>
            @endhasrole
            <li>
              <a href="{{ route('Transactions.index') }}">
                <i class="fa fa-dollar" aria-hidden="true"></i>
                <span>Transactions</span>
              </a>
            </li>
            <li>
              <a href="{{ route('Invoices.index') }}">
                <i class="fa fa-address-book" aria-hidden="true"></i>
                <span>Invoices</span>
              </a>
            </li>
              <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </li>
          </ul>
        </div>
      </div><!-- /#sidebar -->
      <div id="main-nav">

      </div>
      @section('body')
        @show
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
    // $('#transaction-type').on('show.bs.modal', function (event) {
    //   var button = $(event.relatedTarget) // Button that triggered the modal
    //   var id = button.data('id') // Extract info from data-* attributes
    //   // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    //   // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    //   var modal = $(this)
    //   modal.find('.modal-body #company').val(id);
    //   })
    </script>
  </body>
</html>
