<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Cooket') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.css') }}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-green.min.css') }}">

  <style type="text/css">
    .sixtysixty {
      width: 120px;
      height: 120px;
    }
    .events-margin {
      padding: 1em;
    }
  </style>

  <!-- Source Sans Pro Font -->
  <link rel="stylesheet"
        href="{{ asset('source-sans-pro/source-sans-pro.css') }}">
</head>
<body class="hold-transition skin-green sidebar-mini layout-boxed">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/" class="logo">
      <span class="logo-lg">{{ config('app.name', 'Cooket') }}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <section class="sidebar">

      {!! App\Support\MenuBuilder::buildMenu() !!}
      
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="control-sidebar-home-tab">
        @if(Auth::check())
        <div class="user-panel">
		  <div class="pull-left image">
			@if(env("APP_DEPLOYMENT", "local") == "global")
				<img src="{{ Gravatar::src(Auth::user()->email) }}" class="img-circle" alt="User Image">
			@else
				<img src="{{ asset('avatar.png') }}" class="img-circle" alt="User Image">
			@endif	
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->given_name }}&nbsp;{{ Auth::user()->family_name }}</p>
            {{ Auth::user()->nickname }}
          </div>
        </div>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">{{ trans('panel.options') }}</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="/home">
              <i class="menu-icon fa fa-user"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">{{ trans('panel.userpanel') }}</h4>
                <p>{{ trans('panel.userpaneldesc') }}</p>
              </div>
            </a>
          </li>

          <li>
            <a href="/archive">
              <i class="menu-icon fa fa-ticket"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">{{ trans('panel.archive') }}</h4>
                <p>{{ trans('panel.archi_desc') }}</p>
              </div>
            </a>
          </li>

          <li>
            <a href="/logout">
              <i class="menu-icon fa fa-home"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">{{ trans('auth.logout') }}</h4>
                <p>{{ trans('panel.logoutdesc') }}</p>
              </div>
            </a>
          </li>
        </ul>

        {!! App\Support\MenuBuilder::buildPicker() !!}
        
        <!-- /.control-sidebar-menu -->
        @else
          <ul class="control-sidebar-menu">
            <li>
              <a href="/login">
                <i class="menu-icon fa fa-key"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">{{ trans('auth.login') }}</h4>
                  <p>{{ trans('panel.logindesc') }}</p>
                </div>
              </a>
            </li>

            <li>
              <a href="/register">
                <i class="menu-icon fa fa-user"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">{{ trans('auth.register') }}</h4>
                  <p>{{ trans('panel.registerdesc') }}</p>
                </div>
              </a>
            </li>
          </ul>
        @endif
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.table-nice').DataTable();
  } );
</script>

</body>
</html>
