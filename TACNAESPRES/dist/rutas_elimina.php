<?php
$codigo = $_GET["codigo"];
include_once('includes/acceso.php');
include_once('clases/Ruta.php');
$conexion = connect_db();
$oproveedor = new Ruta();
$oproveedor->conectar_db($conexion);
$res=$oproveedor->borrar($codigo);
if ($res)
{
    echo "
        <script>
            alert('Se Elimino Con Éxito');
            javascript:history.go(-1)
        </script>";
    }
else{
    echo"
        <script>
            alert('No Se Pudo Eliminar Cliente');
            window.location.back();
        </script>";}
?>