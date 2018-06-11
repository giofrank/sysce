<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../static/assets/images/favicon-cecin.png">
    <title>CECIN UNDAC</title>
    <!-- Bootstrap Core CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="../DataTables/datatables.css"> -->

    <link href="../static/assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../static/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../static/css/colors/default.css" id="theme" rel="stylesheet">

 
    



</head>

<body class="fix-header card-no-border fix-sidebar">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">CECIN - UNDAC</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../static/assets/images/logo-cecin.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="../static/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="../static/assets/images/large.png" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->    
                         <img src="../static/assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item hidden-xs-down search-box"> <a class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-search"></i></a>
                            <form class="app-search" id="form_1" method="GET" action="/sysce/home/list.php">
                                <input name="id" id="search_person" type="text" class="form-control" placeholder="Digite un DNI ..."> <a href="#" class="srh-btn"><i class="fa fa-times"></i></a> 
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src='../static/assets/images/users/<?php echo $retVal = ($_SESSION['sexo']=='M') ? "3.jpg" : "8.jpg" ; ?>' alt="user" class="" /> <span class="hidden-md-down"><?php echo $_SESSION['full_name']; ?> &nbsp;</span> </a>
                        </li>
                        <ul class="navbar-nav my-lg-0">
                            <li class="nav-item dropdown u-pro">
                            <a href="../destroy.php" class="nav-link dropdown-toggle waves-effect waves-dark profile-pic"><span>Cerrar Sesion</span></a>
                            </li>
                        </ul>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->

                <?php if ($_SESSION['rol'] == 1) { ?>
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="/sysce/home/" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-user-circle-o"></i><span class="hide-menu">Perfil</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-table"></i><span class="hide-menu">Notas</span></a>
                            <ul>
                                <li><a class="waves-effect waves-dark" href="../notes/index.php" aria-expanded="false"><i class="fa fa-hashtag"></i><span class="hide-menu"> Notas </span></a></li>
                            </ul>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-id-badge"></i><span class="hide-menu">Alumnos</span></a>
                            <ul>
                                <li><a class="waves-effect waves-dark" href="../student/index.php" aria-expanded="false"><i class="fa fa-hashtag"></i><span class="hide-menu"> Alumnos </span></a></li>
                                <li><a class="waves-effect waves-dark" href="../student/new.php" aria-expanded="false"><i class="fa fa-hashtag"></i><span class="hide-menu"> Nuevo alumno</span></a></li>
                            </ul>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Cursos</span></a>
                            <ul>
                                <li><a class="waves-effect waves-dark" href="../course/list_course.php" aria-expanded="false"><i class="fa fa-hashtag "></i><span class="hide-menu"> Listar cursos</span></a></li>
                                <li><a class="waves-effect waves-dark" href="../course/form_course.php?tipo_course=1" aria-expanded="false"><i class="fa fa-hashtag"></i><span class="hide-menu"> Nuevo curso</span></a></li>
                                <li><a class="waves-effect waves-dark" href="../speciality/list_esp.php" aria-expanded="false"><i class="fa fa-hashtag "></i><span class="hide-menu"> Listar especialidades</span></a></li>
                                <li><a class="waves-effect waves-dark" href="../speciality/form_esp.php?tipo_es=1" aria-expanded="false"><i class="fa fa-hashtag"></i><span class="hide-menu"> Nueva especialidad</span></a></li>
                            </ul>
                        </li>
                        
                        <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-address-book-o"></i><span class="hide-menu">Grupos</span></a>
                            <ul>
                                <li><a class="waves-effect waves-dark" href="../group/index.php" aria-expanded="false"><i class="fa fa-hashtag "></i><span class="hide-menu"> Listar Grupos</span></a></li>
                                <li><a class="waves-effect waves-dark" href="../group/new.php?tipo_group=1" aria-expanded="false"><i class="fa fa-hashtag"></i><span class="hide-menu"> Nuevo Grupo</span></a></li>
                            </ul>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-bookmark-o"></i><span class="hide-menu">Lista de Usuario</span></a>
                            <ul>
                                <li><a class="waves-effect waves-dark" href="../user/index.php" aria-expanded="false"><i class="fa fa-hashtag"></i><span class="hide-menu"> Listar Usuarios</span></a></li>
                                <li><a class="waves-effect waves-dark" href="../user/new_user.php?tipo_us=1" aria-expanded="false"><i class="fa fa-hashtag"></i><span class="hide-menu"> Nuevo Usuario</span></a></li>
                            </ul>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa  fa-suitcase"></i><span class="hide-menu">Docente</span></a>
                            <ul>
                                <li><a class="waves-effect waves-dark" href="../teacher/list.php" aria-expanded="false"><i class="fa fa-hashtag"></i><span class="hide-menu"> Lista </span></a></li>
                                <li><a class="waves-effect waves-dark" href="../teacher/form_dc.php?tipo_dc=1" aria-expanded="false"><i class="fa fa-hashtag"></i><span class="hide-menu"> Nuevo docente</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <?php  } ?>

                <?php if ($_SESSION['rol'] == 2): ?>
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-table"></i><span class="hide-menu">Notas</span></a>
                                <ul>
                                    <li><a class="waves-effect waves-dark" href="../notes/index.php" aria-expanded="false"><i class="fa fa-hashtag"></i><span class="hide-menu"> Notas </span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                <?php endif ?>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->