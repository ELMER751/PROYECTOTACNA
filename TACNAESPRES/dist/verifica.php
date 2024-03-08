<?php
include_once('includes/acceso.php');
$conexion = connect_db();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre de usuario enviado por AJAX
    $nombreUsuario = $_POST["Nombre_d_Usuario"];
    // Consultar si el nombre de usuario ya existe en la tabla fuser
    $sql = "SELECT * FROM fuser WHERE USUARIO = '$nombreUsuario'";
    $result = $conexion->query($sql);
    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        echo "El nombre de usuario ya existe en la tabla";
    } else {
    }
}
?>