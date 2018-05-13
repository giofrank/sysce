<?php session_start(); 

try{
    include ('conexion/conexion.php');
    $clase = new sistema;
    $clase->conexion();

    $login = htmlentities(addslashes($_POST['username']));
    $senha = mysql_escape_string(MD5($_POST['password']));

    if (isset($senha)) {

        $sql=mysql_query("SELECT * FROM USUARIO WHERE user='$login' AND password='$senha';");
            if(mysql_num_rows($sql)>0)

                $sql=mysql_query("SELECT * FROM USUARIO INNER JOIN PERSONA ON USUARIO.user = PERSONA.dni WHERE dni = '$login';");  
                $row = mysql_fetch_array($sql); 

                $_SESSION["dni"]=$row['user'];
                $_SESSION["full_name"]=$row['a_paterno']." ".$row['a_materno'].", ".$row['nombres'];
                $_SESSION["rol"]=$row["id_rol"];
                $_SESSION["sexo"]=$row["sexo"];
                header("location: index.php");
    }else{
        header("location: login.php");
        echo "Ingrese contraseña";
    }



} catch (Exception $e) {
    die("Error".$e->getMessage());
}

 ?>