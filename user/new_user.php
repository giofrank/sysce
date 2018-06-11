<?php 

    session_start(); 

    include "../conexion/conexion.php"; 
    $clase = new sistema;
    if (!isset($_SESSION["dni"])) {
        header("location: ../login.php");
    }

?>

<!-- =================================HEADER================ -->
<?php include '../extends/header.php' ?>
<!-- =================================END - HEADER================ -->

<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Alumnos</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Nuevo usuario</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row col-lg-12">
                    <form class="form-horizontal form-material" method="POST" action="php/new_us.php" autocomplete="off">

                    <div class="col-lg-12">
                        <div class="card ">
                            <div class="card-body ">
                            <h5 class="card-title text-success">-Nuevo usuario:</h5>
                                <hr><br>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <b>DNI:</b>
                                        <input type="text" name="dni" placeholder="Ingrese DNI" class="form-control form-control-line">
                                    </div>
                                    <div class="col-md-4">
                                        <b>Contraseña:</b>
                                        <input type="password" name="pass1" class="form-control form-control-line" autocomplete="off">
                                    </div>
                                    <div class="col-md-4">
                                        <b>Repita la contraseña:</b>
                                        <input type="password" name="pass2"  class="form-control form-control-line" autocomplete="new-password">
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <button class="btn btn-success">Crear usuario</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>




                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

            </div>
<!-- =================FOOTER================ -->
<?php include '../extends/footer.php' ?>
<!-- =================END - FOOTER================ -->