<?php
class BaseDatos
{
    var $host="localhost";
    var $dbname="db_cecin";
    var $usuario="root";
    var $clave="12345";

    function ConectaBD()
    {
        try
        {
            return array (1,new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->usuario,$this->clave));
        }
        catch (PDOException $e)
        {
            return array (0,$e->getMessage());          
        }
}
function RetornaConsulta($consulta,$parametros)
{
    $resultado=$this->ConectaBD();
    if ($resultado[0]==1)
    {
        $conexion=$resultado[1];
        $resultado=$conexion->prepare($consulta);
        if ($resultado->execute($parametros))
            return array (true,$resultado);
        else
            return array (false,$resultado->errorInfo());
    }
    else
        return array (false,$resultado[1]);
    }
}