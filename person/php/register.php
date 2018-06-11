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


    $bd_query= mysql_query("SELECT * FROM PERSONA
                            WHERE PERSONA.dni='$dni'");

    if (mysql_num_rows($bd_query)>0) {
        // insert student
        echo '<script language="javascript">alert("Ya tiene la persona creada verifique el dni");</script>';
        echo "<script> window.location='/sysce/user/new_user.php?tipo_us=1'; </script>";

    }else{
        // insert person
        mysql_query("INSERT INTO PERSONA (a_paterno, a_materno, nombres, dni, sexo, celular,correo, direccion) VALUES('$a_paterno','$a_materno', '$nombres','$dni', '$sexo', '$phone', '$correo','$direccion')");

        $pkey=mysql_insert_id();
        if (isset($pkey)) {
            $pkt=mysql_insert_id();
                echo '<script language="javascript">alert("Ya puede crear el usuario");</script>';
               echo "<script> window.location='/sysce/user/new_user.php?tipo_us=1'; </script>";
        }


    }

 ?>