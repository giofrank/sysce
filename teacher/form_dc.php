<?php 

    session_start(); 

    include "../conexion/conexion.php"; 
    $clase = new sistema;
    if (!isset($_SESSION["dni"])) {
        header("location: ../login.php");
    }

?>

<?php 
    $clase->conexion();

    $param = $_REQUEST['tipo_dc']; 
    
    if ($param == 1) {
        $a_paterno  = "";
        $a_materno  = "";
        $nombres    = "";
        $dni        = "";
        $correo     = "";
        $phone      = "";
        $sexo       = "";
        $direccion  = "";

    // Student

        $profesion     = "";
        $link_cv       = "";
        $descripcion   = "";
        $state         = "" ;

    }elseif ($param == 2) {

        $key=$_REQUEST['key'];


        $query_gp = mysql_query("SELECT * FROM PROFESOR
                        INNER JOIN PERSONA ON PROFESOR.id_persona = PERSONA.id_persona WHERE PROFESOR.id_profesor='$key'");

        $row_gp = mysql_fetch_array($query_gp);

        $a_paterno  = $row_gp['a_paterno'];
        $a_materno  = $row_gp['a_materno'];
        $nombres    = $row_gp['nombres'];
        $dni        = $row_gp['dni'];
        $correo     = $row_gp['correo'];
        $phone      = $row_gp['celular'];
        $sexo       = $row_gp['sexo'];
        $direccion  = $row_gp['direccion'];

    // Student

        $profesion     = $row_gp['profesion'];
        $link_cv       = $row_gp['link_cv'];
        $descripcion   = $row_gp['descripcion'];
        $state         = $row_gp['state'];


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
                        <h3 class="text-themecolor">Docente</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Nuevo Docente</li>
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
                                <input type="hidden" name="tipo_gp" id="tipo" value="<?php echo($param)?>"/>
                                    <?php if (isset($key)): ?>
                                        <input type="hidden" name="id" id="id" value="<?php echo  $key; ?>"/>
                                    <?php endif ?>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <b>Apellido Paterno: </b>
                                            <input value="<?php echo $a_paterno; ?>" type="text" name="a_paterno" placeholder="Ramirez" class="form-control form-control-line">
                                        </div>
                                        <div class="col-4">
                                            <b>Apellido Materno: </b>
                                            <input value="<?php echo $a_materno; ?>" type="text" name="a_materno" placeholder="Ramirez" class="form-control form-control-line">
                                        </div>
                                        <div class="col-4">
                                            <b>Nombres: </b>
                                            <input value="<?php echo $nombres; ?>" type="text" name="nombres" placeholder="Pedro" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>DNI: </b>
                                            <input value="<?php echo $dni; ?>" type="number" name="dni" placeholder="7177555" class="form-control form-control-line">
                                        </div>
                                        <div class="col-md-6">
                                            <b>Correo:</b>
                                            <input value="<?php echo $correo; ?>" type="email" name="correo" placeholder="johnathan@admin.com" class="form-control form-control-line" id="example-email">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>Celular</b>
                                            <input value="<?php echo $phone; ?>" type="number" name="phone" placeholder="123 456 7890" class="form-control form-control-line">
                                        </div>
                                        <div class="col-sm-6">
                                            <b>Sexo:</b>
                                            <select class="form-control form-control-line" name="sexo">
                                                <option value="M" <?php if($sexo=="M"){echo "selected";} ?>>Masculino</option>
                                                <option value="F" <?php if($sexo=="F"){echo "selected";} ?>>Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Dirección:</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" name="direccion" class="form-control form-control-line"> <?php echo $direccion; ?></textarea>
                                        </div>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title text-success">-Datos del docente:</h5>
                                <hr><br>
                                <div class="form-group row">
                                    <div class="col-md-5">
                                        <b>Profesion:</b>
                                        <input value="<?php echo $profesion; ?>" type="text" name="profesion" placeholder="" class="form-control form-control-line">
                                    </div>
                                    <div class="col-md-7">
                                        <b>Url(*):</b>
                                        <input value="<?php echo $link_cv; ?>" type="text" name="link_cv" placeholder="" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <b >Descripcion:</b>
                                        <textarea rows="3" name="descripcion" class="form-control form-control-line" ><?php echo $descripcion; ?></textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Estado:</b>
                                        <select name="state"  class="form-control" required>
                                            <option value="A" <?php if($state=="A"){echo "selected";} ?>>Activo</option>
                                            <option value="E" <?php if($state=="I"){echo "selected";} ?>>Inactivo</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <button class="btn btn-success">Enviar</button>
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