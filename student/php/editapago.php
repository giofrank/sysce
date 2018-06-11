<?php
    header('Content-Type: text/html; charset=iso-8859-1'); 
    session_start(); 

    include "../../conexion/conexion.php"; 
    $clase = new sistema;
    if (!isset($_SESSION["dni"])) {
        header("location: ../login.php");
    }

$clase->conexion();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysql_query("SELECT * FROM PAGO_ALUMNO WHERE id_pago = '$id'");
$valores2 = mysql_fetch_array($valores);

$datos = array(
                0=>$valores2['id_concepto'],
                1=>$valores2['id_alumno'],
                2=>$valores2['num_recibo'],
                3=>$valores2['descripcion'],
                4=>$valores2['p1'],
                5=>$valores2['p2'],
                6=>$valores2['f_pago'],
                );
echo json_encode($datos);
?>