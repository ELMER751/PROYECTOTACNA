<?php
include_once('includes/acceso.php');
$conexion = connect_db();
global $tabla;
global $pagina;
global $titulo;

// Función para obtener registros
function obtener_registros($dato, $tabla) {
    //echo "nombre $tabla";
    global $conexion;
    // Lógica para obtener los registros de la base de datos
    if (isset($_POST['busqueda']))
    {
        global $query;
    }
    else
    {
        $query = "SELECT * FROM $tabla";
    }
    //echo "$query";
    $resultado = $conexion->query($query);
    $resultado_consul = $conexion->query($query);

    if($resultado->num_rows > 0) {
        // Construir la tabla de resultados dinámicamente

        $tabla_html = '<div class="card card-body"><table class="table table-bordered">';
        $fila_campo = $resultado->fetch_assoc();
        $campos = array_keys($fila_campo);
        $tabla_html .= '<tr class="bg-primary">';
        foreach ($campos as $campo) {
            $tabla_html .= '<th>' . $campo . '</th>';
        }
        $tabla_html .='<th></th>';
        $tabla_html .= '</tr>';
        
        // Rebobinar el puntero de resultados
        mysqli_data_seek($resultado, 0);

        while ($fila_resultado = $resultado->fetch_assoc()) {
            $tabla_html .= '<tr style="background-color: LightCyan;">';
            foreach ($campos as $campo) {
                $tabla_html .= '<td>' . $fila_resultado[$campo] . '</td>';
            }
            $jaladato = $resultado_consul->fetch_row();
            $id = $jaladato[0];
            global $pagina;
            global $titulo;
            if ($titulo === "CLIENTES")
            {
                $tabla_html .= '<td><a style = "border: 0px solid white;" class="btn btn-info add-new" href="Cmodifica_cliente.php?codigo='.$id.'">MODIFICAR</a><p></p><a style="background-color: red; border: 0px solid white;" class="btn btn-info add-new" href="procesos.php?codigo='.$id.'&pag='.$titulo.'">ELIMINAR</a></td>';
                $tabla_html .= '</tr>';
            }
            else if ($pagina === "%2FTacnaExpress%2Fcamiones_busca.php")
            {
                $tabla_html .= '<td><a style = "border: 0px solid white;" class="btn btn-info add-new" href="camiones_modifica.php?codigo='.$id.'">MODIFICAR</a></td>';
                $tabla_html .= '</tr>';
            }
            else if($titulo === "RUTA")
            {
                $tabla_html .= '<td><a style = "border: 0px solid white;" class="btn btn-info add-new" href="rutas_modifica.php?codigo='.$id.'">MODIFICAR</a><p></p><a style="background-color: red; border: 0px solid white;" class="btn btn-info add-new" href="procesos.php?codigo='.$id.'&pag='.$titulo.'">ELIMINAR</a></td>';
                $tabla_html .= '</tr>';
            }
            else if($titulo === "USUARIOS")
            {
                $tabla_html .= '<td><a style = "border: 0px solid white;" class="btn btn-info add-new" href="empleados_modifica.php?codigo='.$id.'">MODIFICAR</a><p></p><a style="background-color: red; border: 0px solid white;" class="btn btn-info add-new" href="procesos.php?codigo='.$id.'&pag='.$titulo.'">ELIMINAR</a></td>';
                $tabla_html .= '</tr>';
            }
            else if($titulo === "TIPO DE PAGOS")
            {
                $tabla_html .= '<td><a style = "border: 0px solid white;" class="btn btn-info add-new" href="tp_modifica.php?codigo='.$id.'">MODIFICAR</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a style="background-color: red; border: 0px solid white;" class="btn btn-info add-new" href="procesos.php?codigo='.$id.'&pag='.$titulo.'">ELIMINAR</a></td>';
                $tabla_html .= '</tr>';
            }
        }
        $tabla_html .= '</table></div>';
    } else {
        $tabla_html = "No se encontraron coincidencias con sus criterios de búsqueda.";
    }
    return $tabla_html;
}

// Obtener el valor de búsqueda (si lo hay)
if(isset($_POST['busqueda'])) {
    $tabla = $_POST['tabla'];
    global $pagina;
    $pagina = $_POST['pagina'];
    global $titulo;
    if(isset($_POST['titulo'])){
    $titulo = $_POST['titulo'];}
    //echo "nombre $tabla";
    $q = $_POST['busqueda'];
    //echo "$q";
    // Lógica para construir la consulta basada en el valor de búsqueda
    $resultado_campos = $conexion->query("SHOW COLUMNS FROM $tabla");
    $campos = array();
    while ($fila_campo = $resultado_campos->fetch_assoc()) {
        $campos[] = $fila_campo['Field'];
    }
    $condiciones = array();
    foreach ($campos as $campo) {
        $condiciones[] = "$campo LIKE '%$q%'";
    }
    global $query;
    $query = "SELECT * FROM $tabla WHERE " . implode(" OR ", $condiciones);
    //echo "$query";

    // Obtener registros y mostrar la tabla
    echo obtener_registros($_POST['busqueda'], $_POST['tabla']);
} else {
    // Si no hay valor de búsqueda, simplemente obtenemos todos los registros
    echo obtener_registros("", $tabla);
}
?>
