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

    $param = $_REQUEST['tipo_us']; 
    
    if ($param == 1) {
        $dni="";

    }elseif ($param == 2) {

        $key=$_REQUEST['dni'];

        $query_gp = mysql_query("SELECT USUARIO.* FROM USUARIO WHERE USUARIO.id_usuario='$key'");

        $row_gp = mysql_fetch_array($query_gp);

        $dni = $row_gp['user'];
        $id_rol = $row_gp['id_rol'];

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
                                <input type="hidden" name="tipo_gp" id="tipo" value="<?php echo($param)?>"/>
                                <?php if (isset($key)): ?>
                                    <input type="hidden" name="id" id="id" value="<?php echo  $key; ?>"/>
                                <?php endif ?>
                                <div class="form-group row">
                                    <div class="col-md-3" >
                                        <b>DNI:</b>
                                        <input type="number" name="dni" placeholder="Ingrese DNI" class="form-control form-control-line" value="<?php echo $dni; ?>" <?php if ($dni!="") {
                                            echo "readonly";
                                        } ?> required>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Contraseña:</b>
                                        <input type="password" name="pass1" class="form-control form-control-line" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Repita la contraseña:</b>
                                        <input type="password" name="pass2"  class="form-control form-control-line" autocomplete="new-password" required>
                                    </div>
                                    <?php 

                                    $query_rol = mysql_query("SELECT ROL.* FROM ROL");


                                    ?> 
                                    <div class="col-md-3">
                                        <b>Rol:</b>
                                        <select name="id_rol"  class="form-control">
                                            <?php if (mysql_num_rows($query_rol)>0): 
                                                while($row_c = mysql_fetch_array($query_rol)){ ?>
                                                
                                                <option value="<?php echo $row_c['id_rol'] ?>" <?php if($row_c['id_rol']==$id_rol){echo "selected";} ?>><?php echo $row_c['nombre']; ?></option>
                                                <?php } ?>
                                            <?php else: ?>
                                                <option value="">No hay registros</option>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3 pull-right ">
                                    <button class="btn btn-success ">Enviar</button>
                                        <a href="index.php" class="btn btn-danger">Cancelar</a>
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