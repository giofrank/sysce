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

$valores = mysql_query("SELECT * FROM ALUMNO_GRUPO WHERE id_alumno_grupo = '$id'");
$valores2 = mysql_fetch_array($valores);

$datos = array(
                0=>$valores2['id_alumno_grupo'],
                1=>$valores2['id_alumno'],
                2=>$valores2['id_grupo'],
                3=>$valores2['a_descripcion'],
                4=>$valores2['a_state'],
                );
echo json_encode($datos);
?>