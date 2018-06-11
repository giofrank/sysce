<?php 
    header('Content-Type: text/html; charset=iso-8859-1'); 
    session_start(); 

    include "../../conexion/conexion.php"; 
    $clase = new sistema;
    if (!isset($_SESSION["dni"])) {
        header("location: ../login.php");
    }

$clase->conexion();

$cod_group = $_POST['cod_group'];
$proceso = $_POST['proceso'];
$id_alumno = $_POST['id_alumno'];
$id_grupo  =   $_POST['grupo'];
$state  =   $_POST['state'];
$descripcion   = $_POST['descripcion'];

switch($proceso){
    case 'registro':
    mysql_query("INSERT INTO ALUMNO_GRUPO (id_alumno, id_grupo, a_descripcion, a_state )VALUES('$id_alumno','$id_grupo', '$descripcion','$state' )");
    break;

    case 'edicion':
    mysql_query("UPDATE ALUMNO_GRUPO SET id_alumno='$id_alumno',id_grupo='$id_grupo',a_descripcion='$descripcion', a_state='$state'  WHERE id_alumno_grupo = '$cod_group'");
    break;
}
?>

<?php 
$query_grups = mysql_query("SELECT ALUMNO_GRUPO.*, GRUPO.*,CURSO.cantidad_horas,CURSO.nombre AS course_name FROM ALUMNO 
                                            INNER JOIN ALUMNO_GRUPO ON ALUMNO.id_alumno=ALUMNO_GRUPO.id_alumno
                                            INNER JOIN GRUPO ON ALUMNO_GRUPO.id_grupo=GRUPO.id_grupo
                                            INNER JOIN CURSO ON GRUPO.id_curso = CURSO.id_curso
                                            WHERE ALUMNO.id_alumno='$id_alumno'");

 ?>

<!-- cargamos registros -->
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
    <tbody>
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