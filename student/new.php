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
                            <li class="breadcrumb-item active">Nuevo alumno</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <form class="form-horizontal form-material" method="POST" action="php/new_alumno.php">
                    <div class="col-lg-12 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                                <h5 class="card-title text-success">-Datos personales:</h5>
                                <hr > <br>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <b>Apellido Paterno: </b>
                                            <input type="text" name="a_paterno" placeholder="Ramirez" class="form-control form-control-line">
                                        </div>
                                        <div class="col-4">
                                            <b>Apellido Materno: </b>
                                            <input type="text" name="a_materno" placeholder="Ramirez" class="form-control form-control-line">
                                        </div>
                                        <div class="col-4">
                                            <b>Nombres: </b>
                                            <input type="text" name="nombres" placeholder="Pedro" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>DNI: </b>
                                            <input type="number" name="dni" placeholder="7177555" class="form-control form-control-line">
                                        </div>
                                        <div class="col-md-6">
                                            <b>Correo:</b>
                                            <input type="email" name="correo" placeholder="johnathan@admin.com" class="form-control form-control-line" id="example-email">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>Celular</b>
                                            <input type="number" name="phone" placeholder="123 456 7890" class="form-control form-control-line">
                                        </div>
                                        <div class="col-sm-6">
                                            <b>Sexo:</b>
                                            <select class="form-control form-control-line" name="sexo">
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Dirección:</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" name="direccion" class="form-control form-control-line"></textarea>
                                        </div>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title text-success">-Datos del estudiante:</h5>
                                <hr><br>
                                <div class="form-group row">
                                    <div class="col-md-5">
                                        <b>Código:</b>
                                        <input type="text" name="codigo" placeholder="18-001" class="form-control form-control-line">
                                    </div>
                                    <div class="col-md-5">
                                        <b>Cargo altual:</b>
                                        <input type="text" name="cargo" placeholder="Egresado" class="form-control form-control-line">
                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <label class="custom-control custom-checkbox">
                                          <input type="checkbox" name="is_undac" class="custom-control-input">
                                          <span class="custom-control-indicator"></span>
                                          <span class="custom-control-description">UNDAC</span>
                                      </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <button class="btn btn-success">Crear estudiante</button>
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