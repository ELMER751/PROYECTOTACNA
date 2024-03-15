<?php
include_once('includes/acceso.php');
$conexion = connect_db();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Nombre_d_Usuario'])){
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
    else if(isset($_POST['pass'])){
        // Obtener el nombre de usuario enviado por AJAX
        $pass = $_POST["pass"];
        // Consultar si el nombre de usuario ya existe en la tabla fuser
        $sql = "SELECT * FROM fuser WHERE PASSWORD = '$pass'";
        $result = $conexion->query($sql);
        $resultado = mysqli_fetch_assoc($result);
        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            $user=$resultado['USUARIO'];
            $respuesta = "Contraseña correcta";
            $response = array("user" => $user, "respuesta" => $respuesta);
            echo json_encode($response);
        } else {
            $respuesta = "Contraseña incorrecta, vuelve a intentar";
            $response = array("respuesta" => $respuesta);
            echo json_encode($response);
        }
        }
}
?>