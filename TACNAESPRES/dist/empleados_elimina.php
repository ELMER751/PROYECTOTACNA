<?php
$codigo = $_GET["codigo"];
include_once('includes/acceso.php');
include_once('clases/registra_usua.php');
$conexion = connect_db();
$oproveedor = new Registro();
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
            alert('No Se Pudo Eliminar Usuario');
            window.location.back();
        </script>";}
?>