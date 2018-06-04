<?php 

    include "../../conexion/conexion.php"; 
    $clase = new sistema;

    $clase->conexion();


    $tipo= $_POST['tipo_gp'];

    $a_paterno  = $_POST['a_paterno'];
    $a_materno  = $_POST['a_materno'];
    $nombres    = $_POST['nombres'];
    $dni        = $_POST['dni'];
    $correo     = $_POST['correo'];
    $celular    = $_POST['phone'];
    $sexo       = $_POST['sexo'];
    $direccion  = $_POST['direccion'];

    // Student

    $profesion     = $_POST['profesion'];
    $link_cv       = $_POST['link_cv'];
    $descripcion   = $_POST['descripcion'];
    $state         = $_POST['state'];



    $bd_query= mysql_query("SELECT * FROM PERSONA
                            WHERE PERSONA.dni='$dni'");

    if ($tipo == 1) {
        # new
        if (mysql_num_rows($bd_query)>0) {
        // insert dc
            $arrayperson = mysql_fetch_array($bd_query);

            $id_person= $arrayperson['id_persona'];

            $bd_profesor = mysql_query("SELECT * FROM PROFESOR
                                WHERE PROFESOR.id_persona='$id_person'");
            if (mysql_num_rows($bd_profesor)>0) {
                $arraystudent = mysql_fetch_array($bd_profesor);
                $id_profesor= $arraystudent['id_profesor'];
                echo "<script> window.location='../list.php'; </script>";
            }else{

                mysql_query("INSERT INTO PROFESOR (profesion, link_cv, descripcion, state, id_persona) VALUES('$profesion','$link_cv', '$descripcion', '$state','$id_person')");

                $pkt=mysql_insert_id();

                if (isset($pkt)) {
                    echo "<script> window.location='../list.php'; </script>";
                    
                }
            }

        }else{
                // insert person
                mysql_query("INSERT INTO PERSONA (a_paterno, a_materno, nombres, dni, sexo, celular,correo, direccion) VALUES('$a_paterno','$a_materno', '$nombres','$dni', '$sexo', '$celular', '$correo','$direccion')");

                $pkey=mysql_insert_id();
                if (isset($pkey)) {
                    mysql_query("INSERT INTO PROFESOR (profesion, link_cv, descripcion,state, id_persona) VALUES('$profesion','$link_cv', '$descripcion', '$state','$id_person')");
                    $pkt=mysql_insert_id();
                    if (isset($pkt)) {
                        echo "<script> window.location='../list.php'; </script>";
                       
                    }

                }


        }
    }elseif ($tipo == 2) {
        # update
        $id  = $_POST['id'];

        mysql_query("UPDATE PROFESOR
                    INNER JOIN PERSONA 
                    ON PROFESOR.id_persona=PERSONA.id_persona
                    SET 
                    PERSONA.a_paterno='$a_paterno',
                    PERSONA.a_materno='$a_materno',
                    PERSONA.nombres='$nombres',
                    PERSONA.dni='$dni',
                    PERSONA.sexo='$sexo',
                    PERSONA.celular='$celular',
                    PERSONA.correo='$correo',
                    PERSONA.direccion='$direccion',

                    PROFESOR.profesion='$profesion',
                    PROFESOR.link_cv='$link_cv',
                    PROFESOR.descripcion='$descripcion',
                    PROFESOR.state='$state'
                    WHERE PROFESOR.id_profesor = '$id'
            ");

        // mysql_query("UPDATE PROFESOR SET  profesion='$profesion',link_cv='$link_cv', descripcion='$descripcion', state='$state' WHERE PROFESOR.id_profesor = '$id'
        //     ");

        $count= mysql_affected_rows();


        if (isset($count)) {
            echo "<script> window.location='../list.php'; </script>";
        }
    }



 ?>