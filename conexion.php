<?php
$servidor="localhost";
$usuario="root";
$contrasena="";
$basedatos="bdfactura";

$conexion=new mysqli($servidor,$usuario,$contrasena,$basedatos);

if($conexion->connect_errno)
{
    die("Error: ".$conexion->connect_errno);
}
?>