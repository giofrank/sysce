<?php 

    session_start(); 

    include "../conexion/conexion.php"; 
    $clase = new sistema;
    if (!isset($_SESSION["dni"])) {
        header("location: ../login.php");
    }

?>

<?php 

    $dni = $_REQUEST['dni']; 
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
                        <h3 class="text-themecolor">Personas</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Nueva persona</li>
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
                    <form class="form-horizontal form-material" method="POST" action="php/register.php">
                    <div class="col-lg-12 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                                <h5 class="card-title text-success">-Datos personales:</h5>
                                <hr > <br>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <b>Apellido Paterno: </b>
                                            <input type="text" name="a_paterno" placeholder="" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-4">
                                            <b>Apellido Materno: </b>
                                            <input type="text" name="a_materno" placeholder="" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-4">
                                            <b>Nombres: </b>
                                            <input type="text" name="nombres" placeholder="" class="form-control form-control-line" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>DNI: </b>
                                            <input type="number" name="dni" value="<?php echo $dni; ?>" class="form-control form-control-line" required>
                                        </div>
                                        <div class="col-md-6">
                                            <b>Correo:</b>
                                            <input type="email" name="correo" placeholder="" class="form-control form-control-line" id="example-email">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>Celular</b>
                                            <input type="number" name="phone" placeholder="" class="form-control form-control-line" required>
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
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Enviar</button>
                                            <a href="/sysce/user/new_user.php?tipo_us=1" class="btn btn-danger">Cancelar</a>
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