<?php 

    include "../../conexion/conexion.php"; 
    $clase = new sistema;

    $clase->conexion();

    header('Content-Type: text/html; charset=iso-8859-1'); 

    $grup = $_REQUEST['grups'];
    if ($grup) {


        $query = mysql_query("SELECT *, PERSONA.* FROM GRUPO 
                                INNER JOIN ALUMNO_GRUPO ON GRUPO.id_grupo=ALUMNO_GRUPO.id_grupo
                                INNER JOIN ALUMNO ON ALUMNO_GRUPO.id_alumno= ALUMNO.id_alumno
                                INNER JOIN PERSONA ON ALUMNO.id_person = PERSONA.id_persona
                                WHERE GRUPO.id_grupo='$grup' ");

        $detailgroup = mysql_query("SELECT *, PERSONA.* FROM GRUPO 
                                INNER JOIN PROFESOR ON GRUPO.id_profesor = PROFESOR.id_profesor
                                INNER JOIN PERSONA ON PROFESOR.id_persona = PERSONA.id_persona
                                WHERE GRUPO.id_grupo='$grup'  ");


    ?>
        <div class="row">
            <div class="col">
                <?php 
                    $info = mysql_fetch_array($detailgroup);
                 ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                  <strong>Docente:</strong> <?php echo $info['a_paterno']." ".$info['a_materno'].", ".$info['nombres']; ?> <br>
                  <strong>Descripcion:</strong> <?php echo $info['2']; ?> <br>
                  <strong>Horario:</strong> <?php echo $info['horario']; ?> <br>
                  <strong>Laboratorio:</strong> <?php echo $info['laboratorio']; ?><br>
                  <strong>Fecha Inicio:</strong> <?php echo $info['f_inicio']; ?><br>
                  <strong>Fecha Fin:</strong> <?php echo $info['f_fin']; ?>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    
        <div class="table-responsive">
            <table class="table table-hover" id="user_table">
                <thead>
                    <tr class="table-dark">
                        <th>#</th>
                        <th>Alumno</th>
                        <th>DNI</th>
                        <th>Celular</th>
                        <th>Descripcion</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                
                <?php if(mysql_num_rows($query)>0){ ?>
                <tbody>
                    <?php 
                    $i=0;
                    while($row = mysql_fetch_array($query)){ ?>
                    <tr class="<?php echo ($row['a_state'] == 'OB')? 'table-danger': ''; ?>">
                        <td><?php echo $i=$i+1; ?></td>
                        <td><?php echo $row['a_paterno']." ".$row['a_materno'].", ".$row['nombres'];?></td>
                        <td><?php echo $row['dni'] ?></td>
                        <td><?php echo $row['celular'] ?></td>
                        <td><?php echo $row['a_descripcion'] ?></td>
                        <td>
                            <a href="profile.php?k=<?php echo base64_encode($row['id_persona']).'&ka='.base64_encode($row['id_alumno']);?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-user-o"></i></a>
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
<?php
    
}else{ ?> 

<div class="alert alert-warning" role="alert">
  <strong>Alerta!</strong> No se encontraron registros en la Base de datos.
</div> 
<?php } ?>
