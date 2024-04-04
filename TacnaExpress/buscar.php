<?php
include_once('includes/acceso.php');
$conexion = connect_db();
global $tabla;
global $pagina;
global $titulo;
global $codi;

// Función para obtener registros
function obtener_registros($dato, $tabla) {
    //echo "nombre $tabla";
    global $conexion;
    global $pagina;
    global $titulo;
    global $codi;
    // Lógica para obtener los registros de la base de datos
    if (isset($_POST['busqueda']))
    {
        global $query;
    }
    else
    {
        $query = "SELECT * FROM $tabla LIMIT 10";
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
        if($titulo === "")
            {
                $tabla_html .= '<th>ACCIÓN</th>';
            }
        foreach ($campos as $campo) {
            $tabla_html .= '<th>' . $campo . '</th>';
        }
        $tabla_html .='<th></th>';
        $tabla_html .= '</tr>';
        
        // Rebobinar el puntero de resultados
        mysqli_data_seek($resultado, 0);

        while ($fila_resultado = $resultado->fetch_assoc()) {
            $jaladato = $resultado_consul->fetch_row();
            $id = $jaladato[0];
            
            $tabla_html .= '<tr style="background-color: LightCyan;">';
            
            if ($titulo === "") {
                if($codi === "BUSCA1") {
                $tabla_html .= '<td><a style="border: 0px solid white; font-size: 8px;" class="btn btn-info add-new" href="javascript:void(0);" onclick="seleccionarDocumento(' . $id . ');">SELECCIONAR</a></td>';
                ?>
                    <script>
                    function seleccionarDocumento(id) {
                        var currentPage = document.location.pathname;
                        var buscaUrl = currentPage.substring(currentPage.lastIndexOf('/') + 1, currentPage.length);
                        var url = buscaUrl + '?codigo=' + id;
                        window.parent.postMessage({ id: id }, window.location.origin); // Reemplaza 'http://tu-sitio.com' con el dominio de tu sitio
                        window.parent.cerrarInterfaz(); // Cierra la interfaz de búsqueda en la página principal
                        
                    }
                    </script>
                <?php
                }
                else if ($codi === "BUSCA2") {
                    $nomb = $jaladato[1];
                    $dire = $jaladato[6];
                    $rucdni = $jaladato[5];
                    $tabla_html .= '<td><a style="border: 0px solid white;font-size: 8px;" class="btn btn-info add-new" href="javascript:void(0);" onclick="seleccionarDocumento(\'' . $nomb . '\', \'' . $dire . '\', \'' . $rucdni . '\');">SELECCIONAR</a></td>';
                    ?>
                    <script>
                        function seleccionarDocumento(nomb1, dire1, rucdni1) {
                            var currentPage = document.location.pathname;
                            var buscaUrl = currentPage.substring(currentPage.lastIndexOf('/') + 1, currentPage.length);
                            var url = buscaUrl + '?codigo=' + rucdni1;
                            window.parent.postMessage({
                                nomb1: nomb1,
                                dire1: dire1,
                                rucdni1: rucdni1
                            }, window.location.origin); // Reemplaza 'http://tu-sitio.com' con el dominio de tu sitio
                            window.parent.cerrarInterfaz(); // Cierra la interfaz de búsqueda en la página principal
                        }
                    </script>
                <?php
                }
                else if ($codi === "BUSCA3") {
                    $nomb = $jaladato[1];
                    $dire = $jaladato[6];
                    $rucdni = $jaladato[5];
                    $tabla_html .= '<td><a style="border: 0px solid white;font-size: 8px;" class="btn btn-info add-new" href="javascript:void(0);" onclick="seleccionarDocumento(\'' . $nomb . '\', \'' . $dire . '\', \'' . $rucdni . '\');">SELECCIONAR</a></td>';
                    ?>
                    <script>
                        function seleccionarDocumento(nomb2, dire2, rucdni2) {
                            var currentPage = document.location.pathname;
                            var buscaUrl = currentPage.substring(currentPage.lastIndexOf('/') + 1, currentPage.length);
                            var url = buscaUrl + '?codigo=' + rucdni2;
                            window.parent.postMessage({
                                nomb2: nomb2,
                                dire2: dire2,
                                rucdni2: rucdni2
                            }, window.location.origin); // Reemplaza 'http://tu-sitio.com' con el dominio de tu sitio
                            window.parent.cerrarInterfaz(); // Cierra la interfaz de búsqueda en la página principal
                        }
                    </script>
                <?php
                }
                else if ($codi === "BUSCA4") {
                    $nomb = $jaladato[1];
                    $dire = $jaladato[6];
                    $rucdni = $jaladato[5];
                    $tabla_html .= '<td><a style="border: 0px solid white;font-size: 8px;" class="btn btn-info add-new" href="javascript:void(0);" onclick="seleccionarDocumento(\'' . $nomb . '\', \'' . $dire . '\', \'' . $rucdni . '\');">SELECCIONAR</a></td>';
                    ?>
                    <script>
                        function seleccionarDocumento(nomb3, dire3, rucdni3) {
                            var currentPage = document.location.pathname;
                            var buscaUrl = currentPage.substring(currentPage.lastIndexOf('/') + 1, currentPage.length);
                            var url = buscaUrl + '?codigo=' + rucdni3;
                            window.parent.postMessage({
                                nomb3: nomb3,
                                dire3: dire3,
                                rucdni3: rucdni3
                            }, window.location.origin); // Reemplaza 'http://tu-sitio.com' con el dominio de tu sitio
                            window.parent.cerrarInterfaz(); // Cierra la interfaz de búsqueda en la página principal
                        }
                    </script>
                <?php
                }
                else if ($codi === "EMPLE") {
                    $docu = $jaladato[0];
                    $tabla_html .= '<td><a style="border: 0px solid white;font-size: 8px;" class="btn btn-info add-new" href="javascript:void(0);" onclick="seleccionarDocumento(\'' . $docu . '\');">SELECCIONAR</a></td>';
                ?>
                    <script>
                        function seleccionarDocumento(docu) {
                            var currentPage = document.location.pathname;
                            var buscaUrl = currentPage.substring(currentPage.lastIndexOf('/') + 1, currentPage.length);
                            window.parent.postMessage({ docu: docu }, window.location.origin); // Reemplaza 'http://tu-sitio.com' con el dominio de tu sitio
                            window.parent.cerrarInterfaz(); // Cierra la interfaz de búsqueda en la página principal
                        }
                    </script>
                <?php
                }
            }
            foreach ($campos as $campo) {
                $tabla_html .= '<td>' . $fila_resultado[$campo] . '</td>';
            }
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
    global $codi;
    if(isset($_POST['codi'])){
    $codi = $_POST['codi'];}
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
