<?php 

    session_start(); 

    include "../conexion/conexion.php"; 
    $clase = new sistema;
    if (!isset($_SESSION["dni"])) {
        header("location: ../login.php");
    }

    $clase->conexion();
    header('Content-Type: text/html; charset=iso-8859-1'); 
    $key = base64_decode($_REQUEST['k']);
    $keys = base64_decode($_REQUEST['ka']);

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
                            <li class="breadcrumb-item active">Lista alumnos</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="#" class="btn waves-effect waves-light btn-primary btn-circle pull-right hidden-sm-down"><i class="fa fa-plus"></i></a>
                    </div>
                </div>

<?php 
if (isset($key)) { ?>


        <?php 


            $query = mysql_query("SELECT * FROM PERSONA 
                                    INNER JOIN ALUMNO ON PERSONA.id_persona = ALUMNO.id_alumno
                                    WHERE PERSONA.id_persona = '$key' ");

            $row = mysql_fetch_array($query); 


         ?>

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="../static/assets/images/users/<?php echo $photo = ($row['sexo']=='M') ? '5.jpg' : '4.jpg' ; ?>" class="img-circle" width="150">
                                    <h4 class="card-title m-t-10"><?php echo $row['a_paterno']." ".$row['a_materno'].", ".$row['nombres']; ?></h4>
                                    <h6 class="card-title m-t-8"><span>DNI: </span><?php echo $row['dni']; ?></h6>
                                    <h6 class="card-subtitle"><span>Codigo: </span><?php echo $row['codigo']; ?></h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="#" class="link"><i class="icon-people"></i> <font class="font-medium"><?php echo $row['cargo']; ?></font></a></div>
                                        <div class="col-4"><a href="#" class="link"><i class="icon-picture"></i> <font class="font-medium"><?php echo $undac = ($row['is_undac']=='1') ? "UNDAC" : "-" ; ?></font></a></div>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                                <form class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">Nombre Completo</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder='<?php echo $row['a_paterno']." ".$row['a_materno']." ".$row['nombres']; ?>' class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Correo</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="<?php echo $row['correo']; ?>" class="form-control form-control-line" name="example-email" id="example-email">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" value="password" class="form-control form-control-line">
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="col-md-12">Celular</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="<?php echo $row['celular']; ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="col-md-12">Descripción</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" class="form-control form-control-line"></textarea>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="col-sm-12">Direccion</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="<?php echo $row['direccion']; ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-primary">Actualizar perfil</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <?php 

                       $query_grups = mysql_query("SELECT ALUMNO_GRUPO.*, GRUPO.*,CURSO.cantidad_horas,CURSO.nombre AS course_name FROM ALUMNO 
                                            INNER JOIN ALUMNO_GRUPO ON ALUMNO.id_alumno=ALUMNO_GRUPO.id_alumno
                                            INNER JOIN GRUPO ON ALUMNO_GRUPO.id_grupo=GRUPO.id_grupo
                                            INNER JOIN CURSO ON GRUPO.id_curso = CURSO.id_curso
                                            WHERE ALUMNO.id_alumno='$keys'"); 

                        $query_notas = mysql_query("SELECT NOTA.*, CURSO.nombre, CURSO.codigo, ESPECIALIDAD.nombre AS esp_name FROM ALUMNO
                                            INNER JOIN NOTA ON ALUMNO.id_alumno= NOTA.id_alumno
                                            INNER JOIN GRUPO ON NOTA.id_grupo=GRUPO.id_grupo
                                            INNER JOIN CURSO ON GRUPO.id_curso = CURSO.id_curso
                                            INNER JOIN ESPECIALIDAD ON CURSO.id_especialidad = ESPECIALIDAD.id_especialidad
                                            WHERE ALUMNO.id_alumno='$keys'"); 

                        $query_pago = mysql_query("SELECT PAGO_ALUMNO.*,CONCEPTO.nombre,CONCEPTO.descripcion as c_des,CONCEPTO.state as c_state FROM ALUMNO
                                            INNER JOIN PAGO_ALUMNO ON ALUMNO.id_alumno=PAGO_ALUMNO.id_alumno
                                            INNER JOIN CONCEPTO ON PAGO_ALUMNO.id_concepto = CONCEPTO.id_concepto
                                            WHERE ALUMNO.id_alumno='$keys'"); 



                     ?>
                    <!-- Column -->
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Grupos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Notas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Pagos</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                      <?php if(mysql_num_rows($query_grups)>0){ ?>
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="user_table">
                                                    <thead>
                                                        <tr class="table-dark">
                                                            <th>#</th>
                                                            <th>Nombre</th>
                                                            <th>Descripcion</th>
                                                            <th>Curso</th>
                                                            <th>Horas</th>
                                                            <th>Inicio</th>
                                                            <th>Fin</th>
                                                            <th>Estado</th>
                                                        </tr>
                                                    </thead>
                                                  <tbody>
                                            <?php 
                                            $i=1;

                                            while($array = mysql_fetch_array($query_grups)){
                                             ?>
                                                    <tr>
                                                      <th scope="row"><?php echo $i++ ?></th>
                                                      <td><?php echo $array['nombre']; ?></td>
                                                      <td><?php echo $array['descripcion']; ?></td>
                                                      <td><?php echo $array['course_name']; ?></td>
                                                      <td><?php echo $array['cantidad_horas']; ?></td>
                                                      <td><?php echo $array['f_inicio']; ?></td>
                                                      <td><?php echo $array['f_fin']; ?></td>
                                                      <td><?php 
                                                          switch ($array['state']) {
                                                            case "A":
                                                            echo '<a class="btn btn-success">Activo</a>';
                                                            break;
                                                            case "P":
                                                            echo '<a class="btn btn-warning">Pendiente</a>';
                                                            break;
                                                            case "F":
                                                            echo '<a class="btn btn-info">Finalizado</a>';
                                                            break;
                                                        }?>
                                                    </tr>
                                                    

                                            <?php } ?>
                                                  </tbody>
                                                </table>
                                            </div>
                                      <?php } ?>

                                  </div>
                                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <?php if(mysql_num_rows($query_notas)>0){ ?>
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="user_table">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th>#</th>
                                                            <th>Codigo</th>
                                                            <th>Curso</th>
                                                            <th>Especialidad</th>
                                                            <th>Nota 1</th>
                                                            <th>Nota 2</th>
                                                            <th>Promedio</th>
                                                        </tr>
                                                    </thead>
                                                  <tbody>
                                            <?php 
                                            $i=0;

                                            while($array2 = mysql_fetch_array($query_notas)){
                                             ?>
                                                    <tr>
                                                      <th scope="row"><?php echo $i=$i+1; ?></th>
                                                      <td><?php echo $array2['codigo'] ?></td>
                                                      <td><?php echo $array2['nombre'] ?></td>
                                                      <td><?php echo $array2['esp_name'] ?></td>
                                                      <td><?php echo $array2['nota1'] ?></td>
                                                      <td><?php echo $array2['nota2'] ?></td>
                                                      <td class='<?php echo $resul = ($array2['promedio']>'11') ? "table-success" : "table-danger" ; ?> '><?php echo $array2['promedio'] ?></td>
                                                     
                                                    </tr>
                                                    

                                            <?php } ?>
                                                  </tbody>
                                                </table>
                                            </div>
                                      <?php } ?>

                                  </div>
                                  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                      <?php if(mysql_num_rows($query_pago)>0){ ?>
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="user_table">
                                                    <thead>
                                                        <tr class="table-warning">
                                                            <th>#</th>
                                                            <th>Recibo</th>
                                                            <th>Concepto</th>
                                                            <th>Fecha</th>
                                                            <th>pago 1</th>
                                                            <th>pago 2</th>
                                                            <th>Estado</th>
                                                            <th>Descripcion</th>
                                                        </tr>
                                                    </thead>
                                                  <tbody>
                                            <?php 
                                            $i=0;

                                            while($array3 = mysql_fetch_array($query_pago)){
                                             ?>
                                                    <tr>
                                                      <th scope="row"><?php echo $i=$i+1; ?></th>
                                                      <td><?php echo $array3['num_recibo'] ?></td>
                                                      <td><?php echo $array3['nombre'] ?></td>
                                                      <td><?php echo $array3['f_pago'] ?></td>
                                                      <td><?php echo $array3['p1'] ?></td>
                                                      <td><?php echo $array3['p1'] ?></td>
                                                      <td><?php echo $array3['state'] ?></td>
                                                      <td><?php echo $array3['descripcion'] ?></td>
                                                     
                                                    </tr>
                                                    

                                            <?php } ?>
                                                  </tbody>
                                                </table>
                                            </div>
                                      <?php } ?>
                                  </div>
                                </div>
                            </div>
                      </div>
                    </div>
                </div>


<?php 
}
?>


                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

</div>
<!-- =================FOOTER================ -->
<?php include '../extends/footer.php' ?>
<!-- =================END - FOOTER================ -->
<script>

</script>