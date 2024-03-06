<?php
    session_start();
    if (!isset($_SESSION["username"])) 
    {
        header("Location: ingresar_sesion.php");
        exit();
    }
?>
<?php
$codigo=$_GET["codigo"];
include_once('includes/acceso.php');
include_once('clases/registra_usua.php');
$conexion = connect_db();
$cliente = new Registro();
$cliente->conectar_db($conexion);
$datos=$cliente->consulta($codigo);
$resultado = mysqli_query($conexion, "SELECT * FROM ruta ORDER BY CODIGO");
?>
<!DOCTYPE html>
<html>
<head>
<title>Iniciar Sesión</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Css/loginnn.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="wrapper">
<style>
    .filled {
        flex: 1; /* Permite que los elementos de entrada y selección compartan el espacio disponible por igual */
        height: 50px;
        background: transparent;
        border-radius: 40px;
        font-size: 10px;
        background-color: #154360; /* Color de fondo para campos llenos */
    }
</style>

<form method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']);?>">
    <h1>Registrar Empleado</h1>
    <div class="input-box <?php echo !empty($datos['USUARIO']) ? 'filled' : ''; ?>">
        <input id="Nombre_d_Usuario" type="text" name="Nombre_d_Usuario" placeholder="Nombre de Usuario" maxlength="3" value="<?php echo $datos['USUARIO']?>" readonly>
    </div>
    <div class="input-box <?php echo !empty($datos['NOMBRES']) ? 'filled' : ''; ?>">
        <input id="Nombre" type="text" name="Nombre" placeholder="Nombre/Apellido" value="<?php echo $datos['NOMBRES']?>" oninput="this.value = this.value.toUpperCase()" required>
    </div>
    <div class="input-box <?php echo !empty($datos['PASSWORD']) ? 'filled' : ''; ?>">
        <input id="Contraseñaa" type="password" name="Contraseñaa" placeholder="Contraseña" value="<?php echo $datos['PASSWORD']?>" required>
    </div>
    <div style="display: flex;">
        <select name="Nivel"  style="flex: 1; margin-right: 10px; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px;">
            <option value="1" style="background-color: black; color: white;" <?php if ($datos['NIVEL'] == 1) echo 'selected' ; ?>>Administrador</option>
            <option value="0" style="background-color: black; color: white;" <?php if ($datos['NIVEL'] == 0) echo 'selected' ; ?>>Operador</option>
        </select>
        <select name="Sede" style="flex: 1; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px; margin-right: 10px;">
                <?php
                    // Iterar sobre los resultados de la consulta y generar opciones para el elemento de selección
                    if ($resultado) {
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='" . $fila['CODIGO'] . "' style='background-color: black; color: white;' " . ($fila['CODIGO'] == $datos['CEDE'] ? 'selected' : '') . ">" . $fila['DESTINO'] . "</option>";
                        }
                        // Liberar el resultado
                        mysqli_free_result($resultado);
                    } else {
                        // Si la consulta falla, mostrar un mensaje de error
                        echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
                    }
                ?>
            </select>
    </div>
    <div class="input-box <?php echo !empty($datos['OCUPACION']) ? 'filled' : ''; ?>">
        <input id="Ocupacion" type="text" name="Ocupacion" placeholder="Ocupación" value="<?php echo $datos['OCUPACION']?>" oninput="this.value = this.value.toUpperCase()" required>
    </div>
    <div class="input-box <?php echo !empty($datos['DNI']) ? 'filled' : ''; ?>">
        <input id="DNI" type="text" name="DNI" placeholder="DNI" value="<?php echo $datos['DNI']?>" maxlength = "8" required>
    </div>
    <div class="input-box <?php echo !empty($datos['BREVETE']) ? 'filled' : ''; ?>">
        <input id="Brevete" type="text" name="Brevete" placeholder="Brevete" value="<?php echo $datos['BREVETE']?>" required>
    </div>
    <div>
        <input type="checkbox" name="miCheck" id="miCheck" <?php if ($datos['ACTI'] == 1) echo 'checked'; ?>>
        <label for="miCheck">Activo</label>
    </div>
    <div class="input-box">
        <button type="submit" name="modificar_empleado" class="btn"><img id="image" src="img/guardar.png" alt="Image 3" width="70px" height="70px"></button>
        <button type="submit" name="busqueda" class="btn" onclick="submitFormWithoutRequired()" disabled><img id="image" src="img/buscar.png" alt="Image 2" width="70px" height="70px"></button>
        <button type="submit" name="cancel" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/eliminar.png" alt="Image 2" width="70px" height="70px"></button>
        <button type="submit" name="volver" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/salir.png" alt="Image 3" width="70px" height="70px"></button>
    </div>
</form>
    <script>
        function submitFormWithoutRequired() {
            var requiredInputs = document.querySelectorAll('input[required]');
                requiredInputs.forEach(function(input) {
                input.removeAttribute('required');
            });
            document.getElementById('miFormulario').submit();
        }
    </script>
</body>
</html>