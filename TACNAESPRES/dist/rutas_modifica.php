<?php
session_start();
if (!isset($_SESSION["username"])) {header("Location: ingresar_sesion.php");exit();}
?>
<?php
    $codigo=$_GET["codigo"];
    include_once('includes/acceso.php');
    include_once('clases/Ruta.php');
    $conexion = connect_db();
    $ruta = new Ruta();
    $ruta->conectar_db($conexion);
    $datos=$ruta->busca($codigo);
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
        <style>
            .input-field {
                flex: 1; /* Permite que los elementos de entrada y selección compartan el espacio disponible por igual */
                height: 50px;
                background: transparent;
                border-radius: 40px;
                font-size: 16px;
                flex: 1; /* Permite que los elementos de entrada y selección compartan el espacio disponible por igual */
                height: 50px;
                border: none;
                outline: none;
                border: 2px solid rgba(255, 255, 255, 0.2);
                border-radius: 40px;
                padding: 20px 45px 20px 20px;
                color: #fff;
            }

            .filled {
                background-color: #154360; /* Color de fondo para campos llenos */
            }

            /* Cambiar color al pasar el ratón por encima */
            .input-field:hover {
                background-color: lightblue;
            }

            /* Cambiar color cuando el select está enfocado */
            .input-field:focus {
                background-color: black;
            }
        </style>

        <body>
            <div class="wrapper">
                <form id="miFormulario" method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']); ?>">
                    <h1>RUTAS-CEDE</h1>
                    <div style="display: flex;">
                        <p>Código :</p>
                        <input id="CODIGO" class="input-field <?php echo !empty($datos['CODIGO']) ? 'filled' : ''; ?>" type="text" name="CODIGO" placeholder="Código" value="<?php echo $datos['CODIGO'];?>" required onkeypress="return handleEnter(event, 'DESTINO')" readonly >
                    </div>
                    <div style="display: flex;">
                        <p>Destino :</p>
                        <input id="DESTINO" class="input-field <?php echo !empty($datos['DESTINO']) ? 'filled' : ''; ?>" type="text" name="DESTINO" placeholder="Destino" value="<?php echo $datos['DESTINO'];?>" required onkeypress="return handleEnter(event, 'ABREVIATURA')" autofocus oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div style="display: flex;">
                        <p>Abreviatura :</p>
                        <input id="ABREVIATURA" class="input-field <?php echo !empty($datos['ABREVIATURA']) ? 'filled' : ''; ?>" type="text" name="ABREVIATURA" placeholder="Abreviatura" value="<?php echo $datos['ABREVIATURA'];?>" required onkeypress="return handleEnter(event, 'DIRECCION')" maxlength="3" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div style="display: flex;">
                        <p>Dirección :</p>
                        <input id="DIRECCION" class="input-field <?php echo !empty($datos['DIRECCION']) ? 'filled' : ''; ?>" type="text" name="DIRECCION" placeholder="Dirección" value="<?php echo $datos['DIRECCION'];?>" required>
                    </div>
                    <div class="input-box">
                        <button type="submit" name="modifica_ruta" class="btn"><img id="image" src="img/guardar.png" alt="image 1" width="70px" height="70px"></button>
                        <button type="submit" name="busqueda" class="btn" onclick="submitFormWithoutRequired()" disabled><img id="image" src="img/buscar.png" alt="image 2" width="70px" height="70px"></button>
                        <button type="submit" name="cancel" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/eliminar.png" alt="Image 3" width="70px" height="70px"></button>
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