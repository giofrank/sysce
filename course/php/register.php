<?php 

    header('Content-Type: text/html; charset=iso-8859-1');
    include "../../conexion/conexion.php"; 
    $clase = new sistema;
    $clase->conexion();


    $tipo= $_POST['tipo_gp'];

    $codigo=$_POST['codigo'];
    $nombre=$_POST['nombre'];
    $descripcion=$_POST['descripcion'];
    $cantidad_horas=$_POST['cantidad_horas'];
    $id_especialidad=$_POST['id_especialidad'];


    if ($tipo == 1) {
        # new
        mysql_query("INSERT INTO CURSO (codigo, nombre, descripcion, cantidad_horas, id_especialidad) VALUES('$codigo','$nombre','$descripcion', '$cantidad_horas','$id_especialidad')");

        $pkt=mysql_insert_id();

            if (isset($pkt)) {
                echo "<script> window.location='../list_course.php'; </script>";
            }
    }elseif ($tipo == 2) {
        # update
        $id  = $_POST['id'];


        mysql_query("UPDATE CURSO SET codigo='$codigo', nombre='$nombre', descripcion='$descripcion', cantidad_horas='$cantidad_horas', id_especialidad='$id_especialidad' WHERE CURSO.id_curso = '$id'
            ");

        $count= mysql_affected_rows();
        if (isset($count)) {
            echo "<script> window.location='../list_course.php'; </script>";
        }
    }

 ?>