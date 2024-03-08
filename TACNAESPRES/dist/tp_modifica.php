<?php
session_start();
if (!isset($_SESSION["username"])) {header("Location: ingresar_sesion.php");exit();}
?>
<?php
    $codigo=$_GET["codigo"];
    include_once('includes/acceso.php');
    include_once('clases/TP.php');
    $conexion = connect_db();
    $tp = new TP();
    $tp->conectar_db($conexion);
    $datos=$tp->busca($codigo);
?>
<!DOCTYPE html>
    <html>
        <head>
        <title>Tipos de pago</title>
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
                <form id="miFormulario" method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']); ?>">
                    <h1>TIPOS DE PAGO</h1>
                    <div class="input-box">
                        <p>Código :</p>
                        <input id="CODIGO" type="text" name="CODIGO" placeholder="Código" value="<?php echo $datos['CODI'];?>" required onkeypress="return handleEnter(event, 'DESC')" readonly >
                    </div>
                    <div class="input-box">
                        <p>Descripción :</p>
                        <input id="DESC" type="text" name="DESC" placeholder="Descripción" value="<?php echo $datos['NOMB'];?>" required onkeypress="return handleEnter(event, 'DIAS')" autofocus oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="input-box">
                        <p>N° de Días :</p>
                        <input id="DIAS" type="text" name="DIAS" placeholder="N° de Días" value="<?php echo $datos['NDIAS'];?>" required onkeypress="return handleEnter(event, 'TC')" maxlength="3" oninput="validarCodigo(this)">
                    </div>
                    <div style="display: flex;">
                        <p>Tipo de Condición :</p>
                        <select name="TC"  style="flex: 1; margin-right: 10px; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px;">
                            <option value="1" style="background-color: black; color: white;" <?php if ($datos['TIPDOC'] == '01') echo 'selected'; ?>>Venta</option>
                            <option value="2" style="background-color: black; color: white;" <?php if ($datos['TIPDOC'] == '02') echo 'selected'; ?>>Compra</option>
                        </select>
                    </div>
                    <div>
                        <input type="checkbox" name="miCheck" id="miCheck" <?php if ($datos['ACTI'] == 1) echo 'checked'; ?>>
                        <label for="miCheck" >Activo</label>
                    </div>
                    <div class="input-box">
                        <button type="submit" name="modificar_tc" class="btn"><img id="image" src="img/guardar.png" alt="image 1" width="70px" height="70px"></button>
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
                function validarCodigo(input) {
                    // Eliminar caracteres no numéricos
                    input.value = input.value.replace(/\D/g, '');
                }
            </script>
        </body>
    </html>