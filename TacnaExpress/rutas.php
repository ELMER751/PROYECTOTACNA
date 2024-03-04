<?php
session_start();
if (!isset($_SESSION["username"])) {header("Location: ingresar_sesion.php");exit();}
?>
<?php
 include_once('includes/acceso.php');
 $conexion = connect_db();
 $ultimo_codigo = mysqli_query($conexion, "SELECT MAX(CODIGO) AS ultimo_codigo FROM ruta");
 $ultimo_codigo = mysqli_fetch_assoc($ultimo_codigo);
 $ultimo_codigo = $ultimo_codigo["ultimo_codigo"];
 mysqli_close($conexion);
?>
<!DOCTYPE html>
    <html>
        <head>
        <title>Clientes rapidos</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="Css/loginnn.css">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="js/interfas.js" ></script>  
        </head>
        <body>
            <div class="wrapper">
                <form id="miFormulario" method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']); ?>">
                    <h1>RUTAS-CEDE</h1>
                    <div class="input-box">
                        <p>Código :</p>
                        <input id="CODIGO" type="text" name="CODIGO" placeholder="Código" value="<?php echo $ultimo_codigo+1?>" required onkeypress="return handleEnter(event, 'DESTINO')" readonly >
                    </div>
                    <div class="input-box">
                        <p>Destino :</p>
                        <input id="DESTINO" type="text" name="DESTINO" placeholder="Destino" required onkeypress="return handleEnter(event, 'ABREVIATURA')" autofocus oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="input-box">
                        <p>Abreviatura :</p>
                        <input id="ABREVIATURA" type="text" name="ABREVIATURA" placeholder="Abreviatura" required onkeypress="return handleEnter(event, 'DIRECCION')" maxlength="3" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="input-box">
                        <p>Dirección :</p>
                        <input id="DIRECCION" type="text" name="DIRECCION" placeholder="Dirección" required>
                    </div>
                    <div class="input-box">
                        <button type="submit" name="guardar_ruta" class="btn"><img id="image" src="img/guardar.png" alt="image 1" width="70px" height="70px"></button>
                        <button type="submit" name="busqueda" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/buscar.png" alt="image 2" width="70px" height="70px"></button>
                        <button type="submit" name="refrescar" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/eliminar.png" alt="Image 3" width="70px" height="70px"></button>
                        <button type="submit" name="volver" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/salir.png" alt="Image 4" width="70px" height="70px"></button>
                    </div>
                </form>
            </div>

            <script>
                function handleEnter(event, nextFieldId) {
                    if (event.keyCode === 13) { // Verifica si la tecla presionada es Enter
                        event.preventDefault(); // Evita que el formulario se envíe automáticamente
                        document.getElementById(nextFieldId).focus(); // Cambia el foco al siguiente campo de texto
                    }
                }
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
            