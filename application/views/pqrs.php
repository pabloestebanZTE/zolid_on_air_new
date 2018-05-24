<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NOC Clientes Especiales - Métricas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="http://cellaron.com/media/wysiwyg/zte-mwc-2015-8-l-124x124.png">
  <link rel="stylesheet" href="<?= URL::to('AdminLTE-2.4.3/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= URL::to('AdminLTE-2.4.3/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= URL::to('AdminLTE-2.4.3/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= URL::to('AdminLTE-2.4.3/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?= URL::to('AdminLTE-2.4.3/dist/css/skins/skin-blue.min.css') ?>">
  <link rel="stylesheet" href="<?= URL::to('assets/css/styleRiskMatrix.css') ?>" />
  <link href="<?= URL::to('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet" type="text/css"/>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>NOC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>NOC</b> - MÉTRICAS</span>
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
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?= URL::to('assets\img\claro.png') ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">CLIENTE NOC</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?= URL::to('assets\img\claro.png') ?>" class="img-circle" alt="User Image">

                <p>
                  Name Lastname - Job title
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?= URL::to('User/principal') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
<!--           <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
 -->        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= URL::to('assets\img\claro.png') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Cliente NOC</p>
          <!-- Status -->
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>
        <!-- Optionally, you can add icons to the links -->
        <li class=""><a href="<?= URL::to('CMetricas/metricas') ?>"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
        
        <!-- elwfk -->
        <li class="treeview active">
          <a href="#"><i class="fa fa-link"></i> <span>Indicadores de Calidad</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="<?= URL::to('CMetricas/nivelServicio') ?>"><i class="fa fa-link"></i><span>Nivel de Servicio y Eficiencia</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>TMO</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= URL::to('CMetricas/tmo') ?>">Principal</a></li>
                <li><a href="<?= URL::to('CMetricas/tmoHist') ?>">Histórico</a></li>
                <li><a href="">Principal FRONT</a></li>
                <li><a href="">Histórico FRONT</a></li>
              </ul>
            </li>
            <li class=""><a href="<?= URL::to('CMetricas/formacion') ?>"><i class="fa fa-link"></i><span>Formación</span></a></li>
            <li class=""><a href="<?= URL::to('CMetricas/rotacionPersonal') ?>"><i class="fa fa-link"></i><span>Rotación de Personal</span></a></li>
            <li class=""><a href="<?= URL::to('CMetricas/productosNoConformes') ?>"><i class="fa fa-link"></i><span>Productos No Conformes</span></a></li>
            <li class=""><a href="<?= URL::to('CMetricas/planesMejora') ?>"><i class="fa fa-link"></i><span>Planes de Mejora<br>Detectados</span></a></li>
            <li class=""><a href="<?= URL::to('CMetricas/horariosAsistenciaIng') ?>"><i class="fa fa-link"></i><span>Horario y Asistencia<br>de Ingenieros</span></a></li>
            <li class="active"><a href=""><i class="fa fa-link"></i><span>PQRS</span></a></li>
            <li class=""><a href="<?= URL::to('CMetricas/evaluacionIng') ?>"><i class="fa fa-link"></i><span>Evaluación Ingenieros</span></a></li>            
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Indicadores de Operación</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="<?= URL::to('CMetricas/proactividadAlarma') ?>"><i class="fa fa-link"></i><span>Proactividad en<br>la Detección de Alarmas</span></a></li>
            <li class=""><a href="<?= URL::to('CMetricas/disponibilidadNOC') ?>"><i class="fa fa-link"></i><span>Disponibilidad NOC Central</span></a></li>
            <li class=""><a href="<?= URL::to('CMetricas/tiempoDiagnostico') ?>"><i class="fa fa-link"></i><span>Tiempo de Diagnóstico</span></a></li>
            <li class=""><a href="<?= URL::to('CMetricas/tiempoDocumentacion') ?>"><i class="fa fa-link"></i><span>Tiempo de Documentación</span></a></li>
            <li class=""><a href="<?= URL::to('CMetricas/asertividad') ?>"><i class="fa fa-link"></i><span>Asertividad de Diagnóstico</span></a></li>
            
            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Porcentaje Solución<br>Incidencia < SLA</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="<?= URL::to('CMetricas/solucionSLA') ?>">Principal</a></li>
                <li><a href="">Detalle Prioridad</a></li>
                <li><a href="">Detalle Prioridad AVAL</a></li>
                <li><a href="">Comportamiento Periodo</a></li>
                <li><a href="">Prioridad Diario</a></li>
                <li><a href="">Analisi</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>MTTR</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= URL::to('CMetricas/MTTR') ?>">Principal</a></li>
                <li><a href="">MTTR Cliente</a></li>
                <li><a href="">MTTR AVAL</a></li>
                <li><a href="">MTTR por Segmento</a></li>
                <li><a href="">MTTR por Prioridad</a></li>
                <li><a href="">Analisis</a></li>
                <li><a href="">Analisis Diario</a></li>
                <li><a href="">Creación de Clientes</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Recurrencias</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= URL::to('CMetricas/recurrencias') ?>">Principal</a></li>
                <li><a href="">Clientes vs Recurrencias</a></li>
                <li><a href="">Detalle</a></li>
                <li><a href="">Gráficas por Resoluciones</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Reincidencias</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= URL::to('CMetricas/reincidencias') ?>">Principal</a></li>
                <li><a href="">Clientes vs Servicio</a></li>
                <li><a href="">Resoluciones vs Servicio</a></li>
                <li><a href="">Reincidencias a Resolución 4</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Disponibilidad de Servicio</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= URL::to('CMetricas/disponibilidadServicio') ?>">Principal</a></li>
                <li><a href="">Detalle por Resolución</a></li>
                <li><a href="">Pareto de Indisponibilidad</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Tickets vs Servicios<br>(ACUM)</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?= URL::to('CMetricas/ticketsServicios') ?>">Principal</a></li>
                <li><a href="">Aval y no Aval</a></li>
                <li><a href="">Prioridades</a></li>
                <li><a href="">Histórico</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Solución<br>Primer Contacto</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= URL::to('CMetricas/solucionPrimerContacto') ?>">Principal</a></li>
                <li><a href="">Principal AVAL</a></li>
                <li><a href="">Hasta Solución Cliente</a></li>
                <li><a href="">Hasta solución cliente AVAL</a></li>
                <li><a href="">comportamiento Periodo</a></li>
                <li><a href="">Comportamiento Periodo Principal</a></li>
              </ul>
            </li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Cierre de Ciclo</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="<?= URL::to('CMetricas/encuestasSatisfaccion') ?>"><i class="fa fa-link"></i><span>Encuesta de Satisfacción</span></a></li>
            <li class=""><a href="<?= URL::to('CMetricas/informeEncuestas') ?>"><i class="fa fa-link"></i><span>informe - Cierre de Ciclo <br>por encuesta</span></a></li>
          </ul>
        </li>
        <!-- elwfk -->

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Peticiones, Quejas, Reclamos, Sugerencias
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->

    <section class="content container-fluid">
      <div class="container autoheight">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                
                <div class="col-lg-11 col-md-11 col-sm-9 col-xs-9 bhoechie-tab" >
                    <div id="planesMejora" data-action="" data-action-update="" >
                        
                        <div class="bhoechie-tab-content active" id="contentTab1">
                            <form class="content-center m-b-20 well form-horizontal" id="form5">
                                <h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Registrar PQRS</h2>
                                <div class="alert alert-success alert-dismissable hidden">
                                    <a href="#" class="close" >&times;</a>
                                    <p class="p-b-0" id="text"></p>
                                </div>

                                <div class="form-group">
                                    <label for="codigoPqrs" class="col-sm-2 control-label">Código</label>
                                    <div class="col-sm-10">
                                        <input class="form-control input-lg" id="codigoPqrs" name="codigoPqrs" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="fechaSolicitudPqrs" class="col-sm-2 control-label">Fecha de la No Conformidad<br>y/o queja</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <input type="text" class="form-control" id="fechaSolicitudPqrs" name="fechaSolicitudPqrs" ><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="reportadorPqrs" class="col-sm-2 control-label">Nombre de Quién Reporta</label>
                                    <div class="col-sm-10">
                                        <input class="form-control input-lg" id="reportadorPqrs" name="reportadorPqrs" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="empresaPqrs" class="col-sm-2 control-label">Empresa</label>
                                    <div class="col-sm-10">
                                        <input class="form-control input-lg" id="empresaPqrs" name="empresaPqrs" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="procesoInvolucradoPqrs" class="col-sm-2 control-label">Proceso Involucrado</label>
                                    <div class="col-sm-10">
                                        <input class="form-control input-lg" id="procesoInvolucradoPqrs" name="procesoInvolucradoPqrs" >
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label for="descripcionPqrs" class="col-sm-2 control-label">Descripción</label>
                                    <div class="col-sm-10">
                                        <textarea name="descripcionPqrs" class="form-control txt-plataforma" id="descripcionPqrs" cols="6" rows="4" placeholder="Descripción de la Petición, Queja, Reclamo o Sugerencia"></textarea><br>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="fuenteOrigenPqrs" class="col-sm-2 control-label">Fuente que la Origina</label>
                                    <div class="col-sm-10">
										                    <input class="form-control input-md" id="fuenteOrigenPqrs" name="fuenteOrigenPqrs" >
                                    </div>
								                </div>

                                <div class="form-group">
                                    <label for="accionPqrs" class="col-sm-2 control-label">Acción</label>
                                    <div class="col-sm-10">
										                    <input class="form-control input-md" id="accionPqrs" name="accionPqrs" >
                                    </div>
								                </div>

                                <div class="form-group">
                                    <label for="medioPqrs" class="col-sm-2 control-label">Medio</label>
                                    <div class="col-sm-10">
										                    <input class="form-control input-md" id="medioPqrs" name="medioPqrs" >
                                    </div>
								                </div>
                                
								
                                <div class="form-group p-t-15">
                                  <div class="col-xs-12">
                                    <a type="submit" class="btn btn-primary" href="#"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Reportar PQRS</a>
                                  </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
      </div>
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="#">ZTE COLOMBIA</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
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
<script src="<?= URL::to('AdminLTE-2.4.3/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= URL::to('AdminLTE-2.4.3/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= URL::to('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?= URL::to('AdminLTE-2.4.3/dist/js/adminlte.min.js') ?>"></script>
<!-- scripts -->
<script src="<?= URL::to('assets/js/modules/riskMatrix.js?v=' . time()) ?>" type="text/javascript"></script>

</body>
</html>