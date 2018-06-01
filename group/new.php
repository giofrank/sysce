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

    $param = $_REQUEST['tipo_group']; 
    
    if ($param == 1) {
        $nombre="";
        $horario="";
        $laboratorio="";
        $f_inicio="";
        $f_fin="";
        $descripcion="";
        $estado="";
        $profesor="";
        $curso="";


    }elseif ($param == 2) {

        $key=$_REQUEST['gp']; 

        $query_gp = mysql_query("SELECT GRUPO.* FROM GRUPO WHERE GRUPO.id_grupo='$key'");

        $row_gp = mysql_fetch_array($query_gp);


        $nombre=$row_gp['nombre'];
        $horario=$row_gp['horario'];
        $laboratorio=$row_gp['laboratorio'];
        $f_inicio=$row_gp['f_inicio'];
        $f_fin=$row_gp['f_fin'];
        $descripcion=$row_gp['descripcion'];
        $estado=$row_gp['state'];
        $profesor=$row_gp['id_profesor'];
        $curso=$row_gp['id_curso'];


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
                        <h3 class="text-themecolor">Grupos</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Nuevo Grupo</li>
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
                    <form class="form-horizontal form-material" method="POST" action="php/new_grupo.php">
                    <div class="col-lg-12 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                                <h5 class="card-title text-success">-Datos acerca del grupo:</h5>
                                <hr > <br>
                                    <input type="hidden" name="tipo_gp" id="tipo" value="<?php echo($param)?>"/>
                                    <?php if (condition): ?>
                                        <input type="hidden" name="id" id="id" value="<?php echo  $key; ?>"/>
                                    <?php endif ?>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <b>Nombre del grupo: </b>
                                            <input type="text" name="nombre" placeholder="" class="form-control form-control-line" value="<?php echo $nombre; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>Horario: </b>
                                            <input type="text" name="horario" placeholder="SABADO 2:30 PM - 7:30 PM" class="form-control form-control-line" value="<?php echo $horario; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <b>Laboratorio:</b>
                                            <input type="text" name="laboratorio" placeholder="Responsable" class="form-control form-control-line" value="<?php echo $laboratorio; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>Fecha-Inicio</b>
                                            <input type="date" name="f_inicio" class="form-control form-control-line" value="<?php echo $f_inicio; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <b>Fecha-Fin</b>
                                            <input type="date" name="f_fin" class="form-control form-control-line" value="<?php echo $f_fin; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <b >Descripcion:</b>
                                            <textarea rows="5" name="descripcion" class="form-control form-control-line" ><?php echo $descripcion; ?></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <b>Estado:</b>
                                            <select name="state"  class="form-control" required>
                                                <option value="P" <?php if($estado=="P"){echo "selected";} ?> >Pendiente</option>
                                                <option value="A" <?php if($estado=="A"){echo "selected";} ?>>Aprobado</option>
                                                <option value="E" <?php if($estado=="E"){echo "selected";} ?>>Rechazado</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                    <?php 

                    

                    $query_pro = mysql_query("SELECT PROFESOR.id_profesor,PERSONA.* FROM PROFESOR
                                        INNER JOIN PERSONA ON PROFESOR.id_persona= PERSONA.id_persona");

                    $query_course = mysql_query("SELECT CURSO.* FROM CURSO");


                     ?>

                    <div class="col-lg-12 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title text-success">-Datos Importantes:</h5>
                                <hr><br>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <b>Profesor:</b>
                                        <select name="profesor"  class="form-control">
                                            <?php if (mysql_num_rows($query_pro)>0): 
                                                while($row_p = mysql_fetch_array($query_pro)){ ?>
                                                
                                                <option value="<?php echo $row_p['id_profesor'] ?>" <?php if($row_p['id_profesor']==$profesor){echo "selected";} ?>><?php echo $row_p['a_paterno']." ".$row_p['a_materno'].", ".$row_p['nombres'] ?></option>
                                                <?php } ?>
                                            <?php else: ?>
                                                <option value="">No hay registros</option>
                                            <?php endif ?>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Curso:</b>
                                        <select name="curso"  class="form-control">
                                            <?php if (mysql_num_rows($query_course)>0): 
                                                while($row_c = mysql_fetch_array($query_course)){ ?>
                                                
                                                <option value="<?php echo $row_c['id_curso'] ?>" <?php if($row_c['id_curso']==$curso){echo "selected";} ?>><?php echo $row_c['nombre']; ?></option>
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