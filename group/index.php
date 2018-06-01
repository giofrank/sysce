<?php 
    header('Content-Type: text/html; charset=iso-8859-1'); 
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
                        <h3 class="text-themecolor">Grupos</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Lista de grupos</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="new.php?tipo_group=1" class="btn waves-effect waves-light btn-primary btn-circle pull-right hidden-sm-down"><i class="fa fa-plus"></i></a>
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

                    $query = mysql_query("SELECT * FROM GRUPO
                                            WHERE GRUPO.state <> 'E';");

                 ?>    

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                              <div class="card-body">
                                <h5 class="card-title text-success">Lista de Grupos</h5>
                                
                                <div class="table-responsive">
                                    <table class="table table-hover" id="user_table">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Horario</th>
                                                <th>Laboratorio</th>
                                                <th>F.Inicio</th>
                                                <th>F.Fin</th>
                                                <th align="center">Estado</th>
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
                                                <td><?php echo $row['nombre'] ?></td>
                                                <td><?php echo $row['horario'] ?></td>
                                                <td><?php echo $row['laboratorio'] ?></td>
                                                <td><?php echo $row['f_inicio'] ?></td>
                                                <td><?php echo $row['f_fin'] ?></td>
                                                <td><?php switch ($row['state']) {
                                                    case 'P':
                                                        echo '<span class="label label-warning label-rounded">Pendiente</span>';
                                                        break;
                                                    case 'A':
                                                        echo '<span class="label label-success label-rounded">Aprobado</span>';
                                                        break;
                                                    case 'F':
                                                        echo '<span class="label label-info label-rounded">Finalizado</span>';
                                                        break;
                                                    
                                                    default:
                                                        echo "No tiene estado";
                                                        break;
                                                } ?></td>
                                                <td>
                                                    <a href="new.php?tipo_group=2&gp=<?php echo $row['id_grupo'];?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-pencil"></i></a>
                                                    <!-- <a href="#" class="btn btn-danger btn-circle btn-sm"><i class="fa  fa-trash-o"></i></a> -->
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