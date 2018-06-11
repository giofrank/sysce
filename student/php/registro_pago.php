<?php 
    header('Content-Type: text/html; charset=iso-8859-1'); 
    session_start(); 

    include "../../conexion/conexion.php"; 
    $clase = new sistema;
    if (!isset($_SESSION["dni"])) {
        header("location: ../login.php");
    }

$clase->conexion();


$cod_pago       =   $_POST['cod_pago'];
$proceso        =   $_POST['proceso_p'];
$id_alumno      =   $_POST['id_alumno'];
$id_concepto    =   $_POST['concepto'];
$p1             =   $_POST['pago_1'];
$p2_1             =   $_POST['pago_2'];
$p2             =   ($p2_1=='') ? 'NULL' : "'".$p2_1."'" ;
$f_pago         =   $_POST['fecha'];
$num_recibo     =   $_POST['num_recibo'];
$state          =   "A";
$descripcion    =   $_POST['descripcion_p'];

switch($proceso){
    case 'registro':
    mysql_query("INSERT INTO PAGO_ALUMNO (descripcion, num_recibo, p1, p2, f_pago, state, id_alumno, id_concepto )VALUES('$descripcion','$num_recibo', '$p1',$p2,'$f_pago','$state','$id_alumno','$id_concepto' )");
    break;

    case 'edicion':
    mysql_query("UPDATE PAGO_ALUMNO SET descripcion='$descripcion' ,num_recibo='$num_recibo' ,p1='$p1',  p2=$p2, f_pago='$f_pago', id_alumno='$id_alumno', id_concepto='$id_concepto' WHERE id_pago = '$cod_pago'");
    break;
}
?>

<?php 
$query_pago = mysql_query("SELECT PAGO_ALUMNO.*,CONCEPTO.nombre,CONCEPTO.descripcion as c_des,CONCEPTO.state as c_state FROM ALUMNO
                                            INNER JOIN PAGO_ALUMNO ON ALUMNO.id_alumno=PAGO_ALUMNO.id_alumno
                                            INNER JOIN CONCEPTO ON PAGO_ALUMNO.id_concepto = CONCEPTO.id_concepto
                                            WHERE ALUMNO.id_alumno='$id_alumno'"); 

 ?>

<!-- cargamos registros -->
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