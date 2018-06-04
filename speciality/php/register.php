<?php 

    header('Content-Type: text/html; charset=iso-8859-1');
    include "../../conexion/conexion.php"; 
    $clase = new sistema;
    $clase->conexion();


    $tipo= $_POST['tipo_gp'];

    $nombre=$_POST['nombre'];
    $descripcion=$_POST['descripcion'];
    $state=$_POST['state'];

    if ($tipo == 1) {
        # new
        mysql_query("INSERT INTO ESPECIALIDAD ( nombre, descripcion, state) VALUES('$nombre','$descripcion', '$state')");

        $pkt=mysql_insert_id();

            if (isset($pkt)) {
                echo "<script> window.location='../list_esp.php'; </script>";
            }
    }elseif ($tipo == 2) {
        # update
        $id  = $_POST['id'];


        mysql_query("UPDATE ESPECIALIDAD SET  nombre='$nombre', descripcion='$descripcion', state='$state' WHERE ESPECIALIDAD.id_especialidad = '$id'
            ");

        $count= mysql_affected_rows();
        if (isset($count)) {
            echo "<script> window.location='../list_esp.php'; </script>";
        }
    }

 ?>