<?php
include_once("../includes/acceso.php");
$conexion = connect_db();
// Realizar una consulta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre de usuario enviado por AJAX
    $nombreUsuario = $_POST["miSelector"];
    // Consultar si el nombre de usuario ya existe en la tabla fuser
    $sql = "SELECT * FROM fuser WHERE USUARIO = '$nombreUsuario'";
    $result = $conexion->query($sql);
    $result = mysqli_fetch_assoc($result);
    // Verificar si se encontraron resultados
    if (isset($result['BREVETE'])) {
        $licencia = $result['BREVETE'];
        $mensaje = "existe";
        $response = array("licencia" => $licencia, "mensaje" => $mensaje);
        echo json_encode($response);
    } else {
        $licencia = "";
        $mensaje = "";
        $response = array("licencia" => $licencia, "mensaje" => $mensaje);
        echo json_encode($response);
    }
}

// Cerrar la conexión
$conexion->close();
?>