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
                        <h3 class="text-themecolor">Usuarios</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Lista de Usuarios</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="#" class="btn waves-effect waves-light btn-primary btn-circle pull-right hidden-sm-down"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

                <?php 
                    $clase->conexion();

                    $query = mysql_query("SELECT * FROM USUARIO 
                                            INNER JOIN PERSONA ON USUARIO.id_persona=PERSONA.id_persona
                                            INNER JOIN ROL ON ROL.id_rol = USUARIO.id_rol
                                            WHERE USUARIO.state='A';");

                 ?>    

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                              <div class="card-body">
                                <h5 class="card-title text-success">Lista de Usuarios</h5>
                                
                                <div class="table-responsive">
                                    <table class="table table-hover" id="user_table">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>#</th>
                                                <th>Persona</th>
                                                <th>username</th>
                                                <th>Rol</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        
                                        <?php if(mysql_num_rows($query)>0){ ?>
                                        <tbody>
                                            <?php 
                                            $i=0;
                                            while($row = mysql_fetch_array($query)){ ?>
                                            <tr>
                                                <td><?php echo $i=$i+1; ?></td>
                                                <td><?php echo $row['a_paterno']." ".$row['a_materno'].", ".$row['nombres'];?></td>
                                                <td><?php echo $row['user'] ?></td>
                                                <td><?php echo $row['nombre'] ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" class="btn btn-danger btn-circle btn-sm"><i class="fa  fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        <?php }else{ ?> 
                                        
                                            <div class="alert alert-warning" role="alert">
                                              <strong>Alerta!</strong> No se encontraron registros en la Base de datos.
                                          </div> 
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                



                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

</div>
<!-- =================FOOTER================ -->
<?php include '../extends/footer.php' ?>
<!-- =================END - FOOTER================ -->
<script>
    

$(document).ready( function () {
    $('#user_table').DataTable();
} );
</script>