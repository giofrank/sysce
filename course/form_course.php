<?php 
    header('Content-Type: text/html; charset=iso-8859-1'); 
    session_start(); 

    include "../conexion/conexion.php"; 
    $clase = new sistema;
    if (!isset($_SESSION["dni"])) {
        header("location: ../login.php");
    }

?>

<?php 
    $clase->conexion();

    $param = $_REQUEST['tipo_course']; 
    
    if ($param == 1) {
        $codigo="";
        $nombre="";
        $descripcion="";
        $cantidad_horas="";
        $id_especialidad="";


    }elseif ($param == 2) {

        $key=$_REQUEST['key']; 

        $query_gp = mysql_query("SELECT CURSO.* FROM CURSO WHERE CURSO.id_curso='$key'");

        $row_gp = mysql_fetch_array($query_gp);


        $codigo=$row_gp['codigo'];
        $nombre=$row_gp['nombre'];
        $descripcion=$row_gp['descripcion'];
        $cantidad_horas=$row_gp['cantidad_horas'];
        $id_especialidad=$row_gp['id_especialidad'];


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
                        <h3 class="text-themecolor">Curso</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Formulario</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="">
                    <form class="form-horizontal form-material" method="POST" action="php/register.php">
                    <div class="col-lg-12 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                                <h5 class="card-title text-success">-Datos acerca del curso:</h5>
                                <hr > <br>
                                    <input type="hidden" name="tipo_gp" id="tipo" value="<?php echo($param)?>"/>
                                    <?php if (isset($key)): ?>
                                        <input type="hidden" name="id" id="id" value="<?php echo  $key; ?>"/>
                                    <?php endif ?>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <b>Nombre del Curso: </b>
                                            <input type="text" name="nombre" placeholder="" class="form-control form-control-line" value="<?php echo $nombre; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>Codigo: </b>
                                            <input type="text" name="codigo" placeholder="" class="form-control form-control-line" value="<?php echo $codigo; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <b>Cantidad de Horas:</b>
                                            <input type="number" name="cantidad_horas" placeholder="" class="form-control form-control-line" value="<?php echo $cantidad_horas; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <b >Descripcion:</b>
                                            <textarea rows="3" name="descripcion" class="form-control form-control-line" ><?php echo $descripcion; ?></textarea>
                                        </div>

                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                    <?php 

                    $query_es = mysql_query("SELECT ESPECIALIDAD.* FROM ESPECIALIDAD");


                     ?>

                    <div class="col-lg-12 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title text-success">-Datos Importantes:</h5>
                                <hr><br>
                                <div class="form-group ">

                                    <div class="col-md-6">
                                        <b>Especialidad:</b>
                                        <select name="id_especialidad"  class="form-control">
                                            <?php if (mysql_num_rows($query_es)>0): 
                                                while($row_c = mysql_fetch_array($query_es)){ ?>
                                                
                                                <option value="<?php echo $row_c['id_especialidad'] ?>" <?php if($row_c['id_especialidad']==$id_especialidad){echo "selected";} ?>><?php echo $row_c['nombre']; ?></option>
                                                <?php } ?>
                                            <?php else: ?>
                                                <option value="">No hay registros</option>
                                            <?php endif ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <button class="btn btn-success">Guardar</button>
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