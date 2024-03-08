<html>
    <body>
        <a>sdasdasdsa</a>
    </body>
</html>
<?php

// Aquí deberías realizar la búsqueda en la base de datos
// Por ejemplo, supongamos que tienes una tabla llamada "usuarios" con columnas "id" y "nombre"
include_once("../includes/acceso.php");
// Simulación de búsqueda (deberías reemplazar esto con tu lógica real de búsqueda en la base de datos)
$terminoBusqueda = isset($_GET['termino_busqueda']) ? $_GET['termino_busqueda'] : '';
$resultados = array();

// Simulación de resultados (reemplaza esto con tu lógica de búsqueda real)
if (!empty($terminoBusqueda)) {
    // Simulación de una conexión a la base de datos
    $conexion = connect_db();
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    
    // Consulta a la tabla usuarios
    $sql = "SELECT id, nombre FROM usuarios WHERE nombre LIKE '%" . $terminoBusqueda . "%'";
    $resultadoConsulta = $conexion->query($sql);

    // Obtener resultados
    if ($resultadoConsulta->num_rows > 0) {
        while ($fila = $resultadoConsulta->fetch_assoc()) {
            $resultados[] = array('id' => $fila['id'], 'nombre' => $fila['nombre']);
        }
    }
    $conexion->close();
}

// Construir la lista de resultados
if (!empty($resultados)) {
    echo '<ul>';
    foreach ($resultados as $usuario) {
        echo '<li onclick="seleccionarValor(' . $usuario['id'] . ')">' . $usuario['nombre'] . '</li>';
    }
    echo '</ul>';
} else {
    echo 'No se encontraron resultados.';
}
?>