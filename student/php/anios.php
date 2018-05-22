<?php 

    include "../../conexion/conexion.php"; 
    $clase = new sistema;

    $clase->conexion();

    header('Content-Type: text/html; charset=iso-8859-1'); 

    $anio = $_GET['id'];
    if ($anio) {


        $query = mysql_query("SELECT * FROM GRUPO 
                                WHERE EXTRACT(YEAR FROM GRUPO.f_inicio) = '$anio' AND GRUPO.state <> 'E' ");


    ?>
    
    <option value="">-Seleccione-</option> 
    <?php 
    
    while($row = mysql_fetch_array($query)){
     ?>
        
        <option value="<?php echo $row['id_grupo'] ?>">
            <?php echo $row['nombre']; ?>
        </option>
    <?php }    
    }
 ?>