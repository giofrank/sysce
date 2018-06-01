<?php 

    
    header('Content-Type: text/html; charset=iso-8859-1'); 
    include "../../conexion/conexion.php"; 
    $clase = new sistema;


    $keyg = $_REQUEST['pg'];
    $keya = $_REQUEST['pa'];
    $n1 = (isset($_REQUEST['n1'])) ? $_REQUEST['n1'] : 0 ;
    $n2 = (isset($_REQUEST['n2'])) ? $_REQUEST['n2'] : 0 ;
    $pf = (isset($_REQUEST['n3'])) ? $_REQUEST['n3'] : 0 ;

    $clase->conexion();
    $bd_query= mysql_query("SELECT NOTA.* FROM ALUMNO
                INNER JOIN NOTA ON ALUMNO.id_alumno=NOTA.id_alumno
                INNER JOIN GRUPO ON NOTA.id_grupo = GRUPO.id_grupo
                WHERE ALUMNO.id_alumno='$keya' AND GRUPO.id_grupo='$keyg'");

    if (mysql_num_rows($bd_query)>0) {
        // update
        $arraynotas = mysql_fetch_array($bd_query);
        $pknote= $arraynotas['id_nota'];
        mysql_query("UPDATE NOTA SET nota1='$n1', nota2='$n2', promedio='$pf'
                                WHERE NOTA.id_nota = '$pknote'
            ");

        $repuesta['res']='verdadero';
        echo json_encode($repuesta, JSON_FORCE_OBJECT);
        
    }else{
        // insert
        mysql_query("INSERT INTO NOTA (nota1, nota2, promedio,id_alumno, id_grupo) VALUES('$n1','$n2', '$pf','$keya', '$keyg')");

        $repuesta['id']=mysql_insert_id();
        $repuesta['res']='verdadero';
        echo json_encode($repuesta, JSON_FORCE_OBJECT);
    }
 ?>