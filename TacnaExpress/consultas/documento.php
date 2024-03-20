<?php
include_once("../includes/acceso.php");
$conexion = connect_db();
// Realizar una consulta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre de usuario enviado por AJAX
    $docu = $_POST["miSelector"];
    // Consultar si el nombre de usuario ya existe en la tabla fuser
    $sql = "SELECT * FROM ftge2007 WHERE CODI = '$docu'";
    $result = $conexion->query($sql);
    $result = mysqli_fetch_assoc($result);
    // Verificar si se encontraron resultados
    if (isset($result['PLAZ'])) {
        $NR = $result['PLAZ'];
        $mensaje = "existe";
        $response = array("nr" => $NR, "mensaje" => $mensaje);
        echo json_encode($response);
    } else {
        $NR = "";
        $mensaje = "";
        $response = array("nr" => $NR, "mensaje" => $mensaje);
        echo json_encode($response);
    }
}

// Cerrar la conexión
$conexion->close();
?>