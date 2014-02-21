<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <title>Helles - Manager</title>
  <meta name="description" content="Helles - Manager">
  <meta name="author" content="Henrique Boaventura">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{ HTML::style('packages/tresyz/helles-manager/css/bootstrap.min.css', array('rel' => 'stylesheet')) }}
  {{ HTML::style('packages/tresyz/helles-manager/css/font-awesome.min.css', array('rel' => 'stylesheet')) }}
  {{ HTML::style('packages/tresyz/helles-manager/css/jquery-ui-1.10.3.custom.min.css', array('rel' => 'stylesheet')) }}
  {{ HTML::style('packages/tresyz/helles-manager/css/fullcalendar.css', array('rel' => 'stylesheet')) }}
  {{ HTML::style('packages/tresyz/helles-manager/css/jquery.gritter.css', array('rel' => 'stylesheet')) }}
  {{ HTML::style('packages/tresyz/helles-manager/css/chosen.min.css', array('rel' => 'stylesheet')) }}
  {{ HTML::style('packages/tresyz/helles-manager/css/jquery.dataTables.css', array('rel' => 'stylesheet')) }}
  {{ HTML::style('packages/tresyz/helles-manager/css/style.min.css', array('rel' => 'stylesheet')) }}
  {{ HTML::style('packages/tresyz/helles-manager/css/manager.css', array('rel' => 'stylesheet')) }}

  <!--[if lt IE 9 ]>
    <link href="assets/css/style-ie.css" rel="stylesheet">
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="assets/js/respond.min.js"></script>
  <![endif]-->
    
</head>

<body>
  <!-- start: Header -->
  @if (Sentry::check())
  <div class="navbar">
    <div class="container">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".sidebar-nav.nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
        <span style="margin: 10px 0px 0px 10px">Área Restrita</span>
      </a>
              
      <!-- start: Header Menu -->
      <div class="header-nav">
        <ul class="nav navbar-nav pull-right">
          <!-- start: User Dropdown -->
          <li class="dropdown hidden-xs">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="index.html#">
              <i class="fa fa-user"></i>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <!-- <li><a href="index.html#"><i class="fa fa-user"></i> Profile</a></li> -->
              {{ HTML::decode(link_to_route('admin.logout', '<i class="icon-off"></i> Sair')) }}
            </ul>
          </li>
          <!-- end: User Dropdown -->
        </ul>
      </div>
      <!-- end: Header Menu -->
      
    </div>
  </div>
  @endif
  <!-- start: Header -->
  
    <div class="container">
      <div class="row">
        @if (Sentry::check())
            <!-- start: Main Menu -->
        <div class="col-sm-2 main-menu-span">
          <div class="sidebar-nav nav-collapse collapse navbar-collapse">
            @section('menu')
              @include('helles-manager::admin.templates._menu')
            @show
            <!-- <ul class="nav nav-tabs nav-stacked main-menu">
              <li><a href="index.html"><i class="fa fa-home icon"></i><span class="hidden-sm"> Dashboard</span></a></li>
              <li><a href="charts.html"><i class="fa fa-bar-chart-o"></i><span class="hidden-sm"> Charts</span></a></li>
              <li>
                <a class="dropmenu" href="index.html#"><i class="fa fa-folder"></i><span class="hidden-sm"> Dropdown</span></a>
                <ul>
                  <li><a class="submenu" href="submenu.html"><i class="fa fa-file"></i><span class="hidden-sm"> Sub Menu 1</span></a></li>
                  <li><a class="submenu" href="submenu.html"><i class="fa fa-file"></i><span class="hidden-sm"> Sub Menu 2</span></a></li>
                  <li><a class="submenu" href="submenu.html"><i class="fa fa-file"></i><span class="hidden-sm"> Sub Menu 3</span></a></li>
                </ul> 
              </li>
              <li><a href="typography.html"><i class="fa fa-font"></i><span class="hidden-sm"> Typography</span></a></li>
              <li><a href="login.html"><i class="fa fa-lock"></i><span class="hidden-sm"> Login Page</span></a></li>
            </ul> -->
          </div><!--/.well -->
        </div><!--/col-->
        <!-- end: Main Menu -->
        
        <noscript>
          <div class="alert alert-block col-sm-10">
            <h4 class="alert-heading">Warning!</h4>
            <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
          </div>
        </noscript>
        
        <div id="content" class="col-sm-10">
          @yield('content')
        </div><!--/#content.span10-->
        @else
        <div id="content" class="col-sm-12">
          <style>
            #content {
              background: none;
            }
            body {
              background-image: url('{{ asset('packages/tresyz/helles-manager/img/bg-login-3yz.jpg') }}');
            }
          </style>
          @yield('content')
        </div><!--/#content.span10-->
        @endif
      </div><!--/fluid-row-->
        

      {{ Form::open(array('method' => 'DELETE', 'id' => 'delete-form')) }}
      <div class="modal fade" id="delete-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Apagar</h4>
            </div>
            <div class="modal-body">
              <p>Deseja realmente excluir esse registro?</p>
            </div>
            <div class="modal-footer">
              {{ Form::submit('Confirmar', array('id' => 'confirm-link', 'class' => 'btn btn-danger')) }}
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      {{ Form::close() }}
    
      <div class="clearfix"></div>

      @if (Sentry::check())
      

      <footer>
        <p>
          <span style="text-align:left;float:right">&copy; <?php echo date('Y') ?> - 3yz.</span>
        </p>
      </footer>
      @endif
          
    </div><!--/.fluid-container-->
  <!--[if !IE]>-->
      {{ HTML::script('packages/tresyz/helles-manager/js/jquery-2.0.3.min.js') }}
  <!--<![endif]-->
  <!--[if IE]>-->
    {{ HTML::script('packages/tresyz/helles-manager/js/jquery-1.10.2.min.js') }}
  <!--[endif]-->
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery-migrate-1.2.1.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/bootstrap.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery-ui-1.10.3.custom.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.knob.modified.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.flot.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.flot.pie.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.flot.stack.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.flot.resize.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.flot.time.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.sparkline.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/fullcalendar.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.gritter.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.dataTables.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/dataTables.bootstrap.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.chosen.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.cleditor.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.autosize.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.maskedinput.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.inputlimiter.1.3.1.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/moment.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/daterangepicker.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/bootstrap-datepicker.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/bootstrap-colorpicker.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/bootstrap-timepicker.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/bootstrap-wysiwyg.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/jquery.placeholder.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/default.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/core.min.js') }}
  {{ HTML::script('packages/tresyz/helles-manager/js/manager.js') }}
  <!-- {{ HTML::script('packages/tresyz/helles-manager/js/pages/index.js') }} -->
  
</body>
</html>
