<?php 

    header('Content-Type: text/html; charset=iso-8859-1');
    include "../../conexion/conexion.php"; 
    $clase = new sistema;
    $clase->conexion();

    $tipo= $_POST['tipo_gp'];

    $dni=$_POST['dni'];
    $pass1=$_POST['pass1'];
    $pass2=mysql_escape_string(MD5($_POST['pass2']));
    $id_rol=$_POST['id_rol'];
    $state="A";

    if ($tipo == 1) {

        # new
        $query_per = mysql_query("SELECT * FROM PERSONA WHERE PERSONA.dni='$dni'");
        $row_ps = mysql_fetch_array($query_per);
        $id_persona = $row_ps['id_persona'];


        mysql_query("INSERT INTO USUARIO ( user, password, state,id_rol, id_persona ) VALUES('$dni','$pass2', '$state', '$id_rol','$id_persona')");

        $pkt=mysql_insert_id();

            if (isset($pkt)) {
                echo "<script> window.location='../index.php'; </script>";
            }
    }elseif ($tipo == 2) {
        # update
        $id  = $_POST['id'];


        mysql_query("UPDATE USUARIO SET  password='$pass2', id_rol='$id_rol' WHERE USUARIO.id_usuario = '$id'
            ");

        $count= mysql_affected_rows();
        if (isset($count)) {
            echo "<script> window.location='../index.php'; </script>";
        }
    }

 ?>