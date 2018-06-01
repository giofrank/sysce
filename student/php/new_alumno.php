<?php 

    include "../../conexion/conexion.php"; 
    $clase = new sistema;

    $clase->conexion();

    $a_paterno  = $_POST['a_paterno'];
    $a_materno  = $_POST['a_materno'];
    $nombres    = $_POST['nombres'];
    $dni        = $_POST['dni'];
    $correo     = $_POST['correo'];
    $phone      = $_POST['phone'];
    $sexo       = $_POST['sexo'];
    $direccion  = $_POST['direccion'];

    // Student

    $codigo  = $_POST['codigo'];
    $cargo   = $_POST['cargo'];
    $is_undac = (isset($_POST['is_undac'])) ? 1 : 2 ;


    $bd_query= mysql_query("SELECT * FROM PERSONA
                            WHERE PERSONA.dni='$dni'");

    if (mysql_num_rows($bd_query)>0) {
        // insert student
        $arrayperson = mysql_fetch_array($bd_query);

        $id_person= $arrayperson['id_persona'];

        $bd_student = mysql_query("SELECT * FROM ALUMNO
                            WHERE ALUMNO.id_person='$id_person'");
        if (mysql_num_rows($bd_student)>0) {
            $arraystudent = mysql_fetch_array($bd_student);
            $id_alumno= $arraystudent['id_alumno'];
            echo "<script> window.location='../profile.php?k=".base64_encode($id_person)."&ka=".base64_encode($id_alumno)."'; </script>";
        }else{

            mysql_query("INSERT INTO ALUMNO (codigo, cargo, is_undac, id_person) VALUES('$codigo','$cargo', '$is_undac','$id_person')");

            $pkt=mysql_insert_id();

            if (isset($pkt)) {
                echo "<script> window.location='../profile.php?k=".base64_encode($id_person)."&ka=".base64_encode($pkt)."'; </script>";
            }
        }

    }else{
        // insert person
        mysql_query("INSERT INTO PERSONA (a_paterno, a_materno, nombres, dni, sexo, celular,correo, direccion) VALUES('$a_paterno','$a_materno', '$nombres','$dni', '$sexo', '$phone', '$correo','$direccion')");

        $pkey=mysql_insert_id();
        if (isset($pkey)) {
            mysql_query("INSERT INTO ALUMNO (codigo, cargo, is_undac, id_person) VALUES('$codigo','$cargo', '$is_undac','$pkey')");
            $pkt=mysql_insert_id();
            if (isset($pkt)) {
               echo "<script> window.location='../profile.php?k=".base64_encode($pkey)."&ka=".base64_encode($pkt)."'; </script>";
            }

        }


    }

 ?>