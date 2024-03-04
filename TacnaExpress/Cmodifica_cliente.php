<?php
session_start();
if (!isset($_SESSION["username"])) {header("Location: ingresar_sesion.php");exit();}
?>
<?php
$codigo=$_GET["codigo"];
include_once('includes/acceso.php');
include_once('Clases/Cliente.php');
$conexion = connect_db();
$cliente = new Cliente();
$cliente->conectar_db($conexion);
$datos=$cliente->busca($codigo);
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
                    <h1>INGRESE DATOS DEL CLIENTE</h1>
                    <div class="input-box">
                        <p>CÓDIGO :</p>
                        <input id="Codigo" type="text" name="Codigo" value="<?php echo $codigo;?>" readonly>
                    </div>
                    <div class="input-box">
                        <p>DNI :</p>
                        <input id="DNI" type="text" name="DNI" placeholder="DNI" value="<?php echo $datos['DNI'];?>" autofocus oninput="validarCodigo(this)" onkeypress="return handleEnter(event, 'RUC')" maxlength="8">
                    </div>
                    <div class="input-box">
                        <p>RUC</p>
                        <input id="RUC" type="text" name="RUC" placeholder="RUC" value="<?php echo $datos['NRUC'];?>" oninput="validarCodigo(this)" onKeypress = "return handleEnter(event, 'Razon_social')"> 
                    </div>
                    <div class="input-box">
                        <p>Razón social :</p>
                        <input id="Razon_social" type="text" name="Razon_social" placeholder="Razón Social" value ="<?php echo $datos['RAZON_SOCIAL'];?>" onkeypress="return handleEnter(event, 'Nombre')">
                    </div>
                    <div class="input-box">
                        <p>Apelli/Nombre :</p>
                        <input id="Nombre" type="text" name="Nombre" placeholder="Nombre" value="<?php echo $datos['NOMB'];?>" onkeypress="return handleEnter(event, 'Direccion')">
                    </div>
                    <div class="input-box">
                        <p>Dirección :</p>
                        <input id="Direccion" type="text" name="Direccion" placeholder="Dirección" value="<?php echo $datos['DIRE'];?>" onkeypress="return handleEnter(event, 'Telefono')">
                    </div>
                    <div class="input-box">
                        <p>Teléfono :</p>
                        <input id="Telefono" type="text" name="Telefono" placeholder="Teléfono" value="<?php echo $datos['FONO'];?>" oninput="validarCodigo(this)" onkeypress="return handleEnter(event, 'Email')">
                    </div>
                    <div class="input-box">
                        <p>Email :</p>
                        <input id="Email" type="text" name="Email" placeholder="Email" value="<?php echo $datos['EMAIL'];?>">
                    </div>
                    <div class="input-box">
                        <button type="submit" name="modifica_cliente" class="btn"><img id="image" src="img/guardar.png" alt="Image 1" width="70px" height="70px"></button>
                        <button type="submit" name="cancel" class="btn"><img id="image" src="img/eliminar.png" alt="Image 2" width="70px" height="70px"></button>
                        <button type="submit" name="volver" class="btn"><img id="image" src="img/salir.png" alt="Image 3" width="70px" height="70px"></button>
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
                function validarCodigo(input) {
                    // Eliminar caracteres no numéricos
                    input.value = input.value.replace(/\D/g, '');
                }

            </script>
        </body>
    </html>