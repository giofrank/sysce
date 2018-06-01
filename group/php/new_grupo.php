<?php 

    header('Content-Type: text/html; charset=iso-8859-1');
    include "../../conexion/conexion.php"; 
    $clase = new sistema;
    $clase->conexion();


    $tipo           = $_POST['tipo_gp'];
    $nombre         = $_POST['nombre'];
    $horario        = $_POST['horario'];
    $laboratorio    = $_POST['laboratorio'];
    $f_inicio       = $_POST['f_inicio'];
    $f_inicio       = ($f_inicio=='') ? 'NULL' : "'".$f_inicio."'";


    $f_fin          = $_POST['f_fin'];

    $f_fin          = ($f_fin=='') ? 'NULL' : "'".$f_fin."'" ;

    $descripcion    = $_POST['descripcion'];
    $state          = $_POST['state'];
    $profesor       = $_POST['profesor'];
    $curso          = $_POST['curso'];


    if ($tipo == 1) {

        # new
        mysql_query("INSERT INTO GRUPO (nombre, descripcion, horario, laboratorio, f_inicio,f_fin, state, id_profesor, id_curso ) VALUES('$nombre','$descripcion', '$horario','$laboratorio', $f_inicio, $f_fin,'$state', '$profesor', '$curso')");

        $pkt=mysql_insert_id();


            if (isset($pkt)) {
                echo "<script> window.location='../index.php'; </script>";
            }
    }elseif ($tipo == 2) {
        # update
        $id  = $_POST['id'];


        mysql_query("UPDATE GRUPO SET nombre='$nombre', descripcion='$descripcion', horario='$horario', laboratorio='$laboratorio',f_inicio=$f_inicio, f_fin=$f_fin ,state='$state',id_profesor='$profesor', id_curso='$curso' WHERE GRUPO.id_grupo = '$id'
            ");

        $count= mysql_affected_rows();
        if (isset($count)) {
            echo "<script> window.location='../index.php'; </script>";
        }
    }

 ?>