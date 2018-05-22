<?php 

    session_start(); 

    include "../conexion/conexion.php"; 
    $clase = new sistema;
    if (!isset($_SESSION["dni"])) {
        header("location: ../login.php");
    }
    header('Content-Type: text/html; charset=iso-8859-1'); 
    $clase->conexion();

    $key = $_REQUEST['id'];

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
                        <h3 class="text-themecolor">Busqueda</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Personas</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="#" class="btn waves-effect waves-light btn-primary btn-circle pull-right hidden-sm-down"><i class="fa fa-plus"></i></a>
                    </div>
                </div>

                <?php 

                    $searchestudent = mysql_query("SELECT * FROM ALUMNO
                                    LEFT JOIN PERSONA ON PERSONA.id_persona=ALUMNO.id_person
                                    WHERE PERSONA.dni LIKE '$key%'");


                    $searchteacher = mysql_query("SELECT * FROM PROFESOR
                                    LEFT JOIN PERSONA ON PERSONA.id_persona=PROFESOR.id_persona
                                    WHERE PERSONA.dni LIKE '$key%' ");

                 ?>

                <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">


                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                      <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Estudiantes</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Docentes</a>
                                      </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">



                                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                      <br>
                                        <?php if (mysql_num_rows($searchestudent)>0) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="user_table">
                                                    <thead>
                                                        <tr class="table-dark">
                                                            <th>#</th>
                                                            <th>Nombres</th>
                                                            <th>DNI</th>
                                                            <th>Celular</th>
                                                            <th>Descripcion</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    
                                                    <tbody>
                                                        <?php 
                                                        $i=0;
                                                        while($row = mysql_fetch_array($searchestudent)){

                                                            ?>
                                                        <tr>
                                                            <td><?php echo $i=$i+1; ?></td>
                                                            <td><?php echo $row['a_paterno']." ".$row['a_materno'].", ".$row['nombres'];?></td>
                                                            <td><?php echo $row['dni'] ?></td>
                                                            <td><?php echo $row['celular'] ?></td>
                                                            <td><?php echo "ALUMNO" ?></td>
                                                            <td>
                                                                <a href="/sysce/student/profile.php?k=<?php echo base64_encode($row['id_persona']).'&ka='.base64_encode($row['id_alumno']);?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-user-o"></i></a>
                                                                
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    
                                                        
                                                    </tbody>
                                                </table>
                                            </div> 
                                      </div>
                                      <?php }else{ ?>
                                       <div class="tab-pane fade show " id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="alert alert-warning" role="alert">
                                                <strong>Alerta!</strong> No se encontraron registros en la Base de datos.
                                            </div> 
                                        </div>
                                      <?php } ?>
                                      <?php if(mysql_num_rows($searchteacher)>0) { ?>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="user_table">
                                                    <thead>
                                                        <tr class="table-dark">
                                                            <th>#</th>
                                                            <th>Nombres</th>
                                                            <th>DNI</th>
                                                            <th>Celular</th>
                                                            <th>Descripcion</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    
                                                    <tbody>
                                                        <?php 
                                                        $i=0;
                                                        while($fila = mysql_fetch_array($searchteacher)){

                                                            ?>
                                                        <tr>
                                                            <td><?php echo $i=$i+1; ?></td>
                                                            <td><?php echo $fila['a_paterno']." ".$fila['a_materno'].", ".$fila['nombres'];?></td>
                                                            <td><?php echo $fila['dni'] ?></td>
                                                            <td><?php echo $fila['celular'] ?></td>
                                                            <td><?php echo "DOCENTE" ?></td>
                                                            <td>
                                                            
                                                                
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    
                                                        
                                                    </tbody>
                                                </table>
                                            </div> 
                                        </div>
                                          

                                      <?php }else{ ?>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="alert alert-warning" role="alert">
                                                <strong>Alerta!</strong> No se encontraron registros en la Base de datos Docentes.
                                            </div>
                                        </div>
                                      
                                      <?php } ?>


                                    </div>



                                </div>
                            </div>
                        </div>
                    
                </div>

</div>
<!-- =================FOOTER================ -->
<?php include '../extends/footer.php' ?>
<!-- =================END - FOOTER================ -->