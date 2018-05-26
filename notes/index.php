<?php 

    session_start(); 

    include "../conexion/conexion.php"; 
    $clase = new sistema;
    if (!isset($_SESSION["dni"])) {
        header("location: ../login.php");
    }
    header('Content-Type: text/html; charset=iso-8859-1'); 
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
                        <h3 class="text-themecolor">Bienvenido</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Cursos</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="#" class="btn waves-effect waves-light btn-primary btn-circle pull-right hidden-sm-down"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                
                <?php 
                $key = $_SESSION["dni"];
                $clase->conexion();

                $query = mysql_query("SELECT * FROM PROFESOR 
                                        INNER JOIN PERSONA ON PROFESOR.id_persona=PERSONA.id_persona
                                        WHERE PERSONA.dni='$key'");
                        $row = mysql_fetch_array($query); 
                        $key_teacher = $row["id_profesor"]
                 ?>

                <div class="row">
                <?php if (mysql_num_rows($query)>0): ?>


                    <?php 
                        $bd_curso = mysql_query("SELECT * FROM PROFESOR
                                    INNER JOIN GRUPO ON PROFESOR.id_profesor = GRUPO.id_profesor
                                    INNER JOIN CURSO ON GRUPO.id_curso = CURSO.id_curso
                                    INNER JOIN ESPECIALIDAD ON CURSO.id_especialidad = ESPECIALIDAD.id_especialidad
                                    WHERE PROFESOR.id_profesor='$key_teacher'");
                     ?>
                    <?php if (mysql_num_rows($bd_curso)>0): ?>
                        <?php while($array = mysql_fetch_array($bd_curso)){ 
                        ?>
                        <div class="col-lg-4">
                            <div class="card">
                                <!-- <div class="up-img" style="background-image:url(../assets/images/big/img1.jpg)"></div> -->
                                <div class="card-body">
                                    <h5 class=" card-title"><?php echo $array['18'] ?></h5>
                                    <span class="label label-info label-rounded"><?php echo $array['23'] ?></span>
                                    <p class="m-b-0 m-t-20"><?php echo $array['19'] ?></p>
                                    <span class="label label-default label-rounded">GRUPO: <?php echo $array['7'] ?></span>
                                    <div class="d-flex m-t-20">
                                        <a class="link" href="detail_group.php?group=<?php echo $array['id_grupo'] ?>">Detalles...</a>
                                        <div class="ml-auto align-self-center">
                                            <a href="#" class="link m-r-10"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="link m-r-10"><i class="fa fa-share-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    <?php else: ?>
                        <div class="col">
                            <div class="alert alert-warning" role="alert">
                                <strong>Aviso!</strong> Tu no tienes cursos asigandos en la plataforma, comunicate con el administrador.
                            </div>
                        </div>
                    <?php endif ?>
                <?php else: ?>
                    <div class="col">
                        <div class="alert alert-warning" role="alert">
                        <strong>Aviso!</strong> Tu no tienes cursos asigandos en la plataforma, comunicate con el administrador, Ud. no es Docente.
                      </div>
                  </div>
              <?php endif ?>

                </div>




                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

            </div>
<!-- =================FOOTER================ -->
<?php include '../extends/footer.php' ?>
<!-- =================END - FOOTER================ -->