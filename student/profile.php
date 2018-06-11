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
<style>
    .bien{
    background-color:#3CBE34;
    text-align:center;
    font-size:14px;
    color:#FFF;
    padding:5px;
}
</style>
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
                                    INNER JOIN ALUMNO ON PERSONA.id_persona = ALUMNO.id_person
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
                                        <a class="nav-link " id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Pagos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Notas</a>
                                    </li>
                                    
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <button type="button" class="btn waves-effect waves-light btn-success btn-circle pull-right" data-toggle="modal" data-target="#ModalGroup" id="new_gp"><i class="fa fa-plus"></i></button>
                                        <hr>




                                      <?php if(mysql_num_rows($query_grups)>0){ ?>
                                            <div class="table-responsive" id="table_grupo">
                                                <table class="table table-hover" id="user_table">
                                                    <thead>
                                                        <tr class="table-dark">
                                                            <th>#</th>
                                                            <th>Nombre</th>
                                                            <th>Curso</th>
                                                            <th>Horas</th>
                                                            <th>Inicio</th>
                                                            <th>Fin</th>
                                                            <th>Descripcion</th>
                                                            <th>Estado</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                  <tbody >
                                            <?php 
                                            $i=1;

                                            while($array = mysql_fetch_array($query_grups)){
                                             ?>
                                                    <tr>
                                                      <th scope="row"><?php echo $i++ ?></th>
                                                      <td><?php echo $array['nombre']; ?></td>
                                                      <td><?php echo $array['course_name']; ?></td>
                                                      <td><?php echo $array['cantidad_horas']; ?></td>
                                                      <td><?php echo $array['f_inicio']; ?></td>
                                                      <td><?php echo $array['f_fin']; ?></td>
                                                      <td><?php echo $array['a_descripcion']; ?></td>
                                                      <td><?php 
                                                          switch ($array['a_state']) {
                                                            case "A":
                                                            echo '<a class="btn btn-success">Aprobado</a>';
                                                            break;
                                                            case "OB":
                                                            echo '<a class="btn btn-warning">Observado</a>';
                                                            break;
                                                            case "R":
                                                            echo '<a class="btn btn-danger">Rechazado</a>';
                                                            break;
                                                        }?>
                                                    </td>
                                                    <td>
                                                    <button onclick="editarGroup(<?php echo $array['id_alumno_grupo'];?>)" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-pencil"></i></button>
                                                    </td>
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
                                  <button type="button" class="btn waves-effect waves-light btn-success btn-circle pull-right" data-toggle="modal" data-target="#Modalpago" id="new_pago"><i class="fa fa-plus"></i></button>
                                        <hr>

                                      <?php if(mysql_num_rows($query_pago)>0){ ?>
                                            <div class="table-responsive" id="table_pago">
                                                <table class="table table-hover" id="user_table">
                                                    <thead>
                                                        <tr class="table-warning">
                                                            <th>#</th>
                                                            <th>Recibo</th>
                                                            <th>Concepto</th>
                                                            <th>Fecha</th>
                                                            <th>pago 1</th>
                                                            <th>pago 2</th>
                                                            <th>Descripcion</th>
                                                            <th>Opciones</th>
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
                                                      <td><?php echo $array3['p2'] ?></td>
                                                      <td><?php echo $array3['descripcion'] ?></td>
                                                      <td>
                                                          <button onclick="editarPago(<?php echo $array3['id_pago'];?>)" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-pencil"></i></button>
                                                      </td>
                                                     
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

<!-- Modal new group -->
<div class="modal fade" id="ModalGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">+ Asignar grupo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="grupoform">
      <div class="modal-body">
        <div class="loadingData">
            <div class="row">
                <input type="text" required="required" readonly="readonly" id="cod_group" name="cod_group" readonly="readonly" hidden>
                <input type="text" name="proceso" id="proceso" hidden>
                <input type="text" name="id_alumno" id="" value="<?php echo $row['id_alumno']; ?>" hidden>
                <div class="col-md-6">
                    <label for="grupo">Grupo:</label>
                    <select name="grupo" id="grupo" class="form-control">
                        <?php  
                           $anio = date('Y');
                            if ($anio) {

                                $bd_gp = mysql_query("SELECT * FROM GRUPO 
                                                        WHERE EXTRACT(YEAR FROM GRUPO.f_inicio) = '$anio' AND GRUPO.state <> 'E' ");
                            }

                        ?>
                        
                        <option value="">-Seleccione-</option> 
                        <?php 
                            while($row_1 = mysql_fetch_array($bd_gp)){
                         ?>
                            <option value="<?php echo $row_1['id_grupo'] ?>">
                                <?php echo $row_1['nombre']; ?>
                            </option>

                        <?php } ?>

                    </select>
                </div>
                <div class="col-md-6">
                    <label for="state">Estado: </label>
                    <select name="state" id="state" class="form-control">
                        <option value="A">Aprobado</option>
                        <option value="OB">Observado</option>
                        <option value="R">Rechazado</option>
                    </select>
                </div>
                
            </div>
            <div>
                <label for="descripcion">Descripcion:</label>
                <textarea rows="3" name="descripcion" id="descripcion" class="form-control form-control-line"></textarea>

            </div>
            <div id="mensaje" ></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button href="#" onclick="savegroup(event)" type="button" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal new pagos -->
<div class="modal fade bd-example-modal-lg"" id="Modalpago" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">+ Asignar pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="pagoform">
      <div class="modal-body">
        <div class="loadingData">
            <div class="row">
                <input type="text" required="required" readonly="readonly" id="cod_pago" name="cod_pago" readonly="readonly" hidden>
                <input type="text" name="proceso_p" id="proceso_p" hidden>
                <input type="text" name="id_alumno" id="" value="<?php echo $row['id_alumno']; ?>" hidden>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="num_recibo"># Recibo:</label>
                    <input type="text" name="num_recibo" id="num_recibo" class="form-control">
                </div>
                <div class="col-md-8">
                    <label for="concepto">Concepto:</label>
                    <select name="concepto" id="concepto" class="form-control">
                        <?php  

                            $bd_concepto = mysql_query("SELECT * FROM CONCEPTO 
                                                        WHERE CONCEPTO.state='A' ");

                        ?>
                        
                        <option value="">-Seleccione-</option> 
                        <?php 
                            while($row_concepto = mysql_fetch_array($bd_concepto)){
                         ?>
                            <option value="<?php echo $row_concepto['id_concepto'] ?>">
                                <?php echo $row_concepto['nombre']; ?>
                            </option>

                        <?php } ?>

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="pago_1">Pago-1:</label>
                    <input type="text" name="pago_1" id="pago_1" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="pago_2">Pago-2:</label>
                    <input type="text" name="pago_2" id="pago_2" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control">
                </div>
                <div class="col-md-8">
                    <label for="descripcion_p">Descripcion:</label>
                    <textarea rows="3" name="descripcion_p" id="descripcion_p" class="form-control form-control-line"></textarea>
                </div>
            </div>
            <div id="mensaje" ></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button href="#" onclick="savepago(event)" type="button" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>

    $('#new_gp').on('click',function(){
        $('#grupoform')[0].reset();
        $('#proceso').val('registro');
    });
    

    $('#new_pago').on('click',function(){
        $('#pagoform')[0].reset();
        $('#proceso_p').val('registro');
    });


    function savegroup(e){
        e.preventDefault();
        var url = "php/registro_grupo.php"
        var formData = new FormData($('#grupoform')[0])

        $.ajax({
        type:'POST',
        url:url,
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(registro){
            if ($('#pro').val() == 'registro'){
            $('#grupoform')[0].reset();
            $('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
            $('#table_grupo').html(registro);
            return false;
            }else{
            $('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
            $('#table_grupo').html(registro);
            return false;
            }
        }
        });

    }

    function editarGroup(id){
        $('#grupoform')[0].reset();
        var url = 'php/editagroup.php';
        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos = eval(valores);
                $('#proceso').val('edicion');
                $('#cod_group').val(id);
                $('#grupo').val(datos[2]);
                $('#state').val(datos[4]);
                $('#descripcion').val(datos[3]);
                $('#ModalGroup').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
        return false;
    }

    function savepago(e){
        e.preventDefault();
        var url = "php/registro_pago.php"
        var formData = new FormData($('#pagoform')[0])

        $.ajax({
        type:'POST',
        url:url,
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(registro){
            if ($('#pro').val() == 'registro'){
            $('#pagoform')[0].reset();
            $('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
            $('#table_pago').html(registro);
            return false;
            }else{
            $('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
            $('#table_pago').html(registro);
            return false;
            }
        }
        });

    }

    function editarPago(id){
        $('#pagoform')[0].reset();
        var url = 'php/editapago.php';
        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos = eval(valores);
                $('#proceso_p').val('edicion');
                $('#cod_pago').val(id);
                $('#concepto').val(datos[0]);
                $('#num_recibo').val(datos[2]);
                $('#descripcion_p').val(datos[3]);
                $('#fecha').val(datos[6]);
                $('#pago_1').val(datos[4]);
                $('#pago_2').val(datos[5]);

                $('#Modalpago').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
        return false;
    }

</script>