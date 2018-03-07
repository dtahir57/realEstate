<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('su-title')</title>

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
          <h4>{{$user->name}}</h4>
        </div>
        <div id="side-menu">
          <ul>
            <li>
              <a href="{{ url('home/companies/'.session('company_id')) }}">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="{{ route('Properties.index') }}">
                <i class="fa fa-home" aria-hidden="true"></i>
                <span>Properties</span>
              </a>
            </li>
            <li>
              <a href="{{ route('Agents.index') }}">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>Agents</span>
              </a>
            </li>
            <li>
              <a href="{{ route('Tasks.index') }}">
                <i class="fa fa-file" aria-hidden="true"></i>
                <span>Tasks</span>
              </a>
            </li>
            <li>
              <a href="{{ route('Transaction-type.index') }}">
                <i class="fa fa-exchange" aria-hidden="true"></i>
                <span>Types</span>
              </a>
            </li>
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
              <a href="{{ route('destroySession') }}">
                <i class="fa fa-arrow-circle-left"></i>
                <span>Back</span>
              </a>
            </li>
          </ul>
        </div>
      </div><!-- /#sidebar -->
      @section('su-body')
        @show
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
