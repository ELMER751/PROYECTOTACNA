<?php
session_start();
if (!isset($_SESSION["username"])) {header("Location: ingresar_sesion.php");exit();}
?>
<?php
//include_once('header.php');
//include_once('includes/acceso.php');
//$conexion = connect_db();
//$ultimo_codigo = mysqli_query($conexion, "SELECT MAX(CODC) AS ultimo_codigo FROM fmclinic");
//$ultimo_codigo = mysqli_fetch_assoc($ultimo_codigo);
//$ultimo_codigo = $ultimo_codigo["ultimo_codigo"];
//mysqli_close($conexion);
?>
<!DOCTYPE html>
    <html>
    <head>
        <title>ESPRESS TACNA</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="Css/loginnn.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <style>
    .error-message {
        color: red;
    }
    2</style>
    <body>
            <div class="wrapper">
                <form id="miFormulario" method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']); ?>">
                    <h1>INGRESE DATOS DEL CLIENTE</h1>
                    <div class="input-box">
                        <p>DNI :</p>
                        <input id="DNI" type="text" name="DNI" placeholder="DNI" autofocus oninput="validarCodigo(this)" onkeypress="return ApiRucDni()" maxlength="8">
                    </div>
                    <span id="error-msg" class="error-message" style="display:none;">El campo debe tener al menos 5 caracteres.</span>
                    <div class="input-box">
                        <p>RUC :</p>
                        <input id="RUC" type="text" name="RUC" placeholder="RUC" oninput="validarCodigo(this)" onKeypress = "return handleEnter(event, 'Razon_social')"> 
                    </div>
                    <div class="input-box">
                        <p>Razón social :</p>
                        <input id="Razon_social" type="text" name="Razon_social" placeholder="Razón Social" onkeypress="return handleEnter(event, 'Nombre')">
                    </div>
                    <div class="input-box">
                        <p>Apelli/Nombre :</p>
                        <input id="Nombre" type="text" name="Nombre" placeholder="Nombre" onkeypress="return handleEnter(event, 'Direccion')">
                    </div>
                    <div class="input-box">
                        <p>Dirección :</p>
                        <input id="Direccion" type="text" name="Direccion" placeholder="Dirección" onkeypress="return handleEnter(event, 'Telefono')">
                    </div>
                    <div class="input-box">
                        <p>Teléfono :</p>
                        <input id="Telefono" type="text" name="Telefono" placeholder="Teléfono" oninput="validarCodigo(this)" onkeypress="return handleEnter(event, 'Email')">
                    </div>
                    <div class="input-box">
                        <p>Email :</p>
                        <input id="Email" type="text" name="Email" placeholder="Email">
                    </div>
                    <div class="input-box">
                        <button type="submit" name="correcto" class="btn"><img id="image" src="img/guardar.png" alt="Image 1" width="70px" height="70px"></button>
                        <button type="submit" name="busqueda" class="btn"><img id="image" src="img/buscar.png" alt="Image 4" width="70px" height="70px"></button>
                        <button type="submit" name="cancel" class="btn"><img id="image" src="img/eliminar.png" alt="Image 2" width="70px" height="70px"></button>
                        <button type="submit" name="volver" class="btn"><img id="image" src="img/salir.png" alt="Image 3" width="70px" height="70px"></button>
                    </div>
                </form>
            </div>

            <script>
                document.getElementById('miFormulario').addEventListener('submit', function(event) {
                    var campo = document.getElementById('');
                    var errorMsg = document.getElementById('error-msg');

                    if (campo.value.length < 5) {
                        errorMsg.style.display = 'inline';
                        event.preventDefault(); // Evitar que el formulario se envíe
                    } else {
                        errorMsg.style.display = 'none';
                    }
                });
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
                function ApiRucDni() 
                {
                    if (event.keyCode === 13) { 
                        event.preventDefault();
                        var dni = document.getElementById('DNI').value; 
                        var ruc = document.getElementById('RUC').value;
                        var xhr = new XMLHttpRequest();
                        var URLDNI = "proxy.php?numero=" + dni;
                        var URLRUC = "proxy.php?numero=" + ruc;
                        
                        if (dni.length === 8) {
                            //URL = "http://api.apis.net.pe/v1/dni?numero=" + rucdni;
                            xhr.open("GET", URLDNI, true);
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 201)) {
                                    var responseData = JSON.parse(xhr.responseText);
                                    console.log(responseData);
                                    document.getElementById('Nombre').value = responseData.nombre || ''; 
                                    document.getElementById('Direccion').value = responseData.direccion || 'Arequipa'; 
                                    document.getElementById('Nombre').focus();
                                } else {
                                    console.log("NO SE ENCONTRO");
                                }
                            };
                            xhr.send();
                        } else if (ruc.length >= 11) {
                            if (ruc.length === 11) {
                                //URL = "http://api.apis.net.pe/v1/ruc?numero=" + rucdni;
                                xhr.open("GET", URLRUC, true);
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 201)) {
                                        var responseData = JSON.parse(xhr.responseText);
                                        console.log(responseData);
                                        document.getElementById('Razon_social').value = responseData.nombre || ''; 
                                        document.getElementById('Direccion').value = responseData.direccion || 'Arequipa'; 
                                        document.getElementById('Razon_social').focus();
                                    } else {
                                        console.log("NO SE ENCONTRO");
                                    }
                                };
                                xhr.send();
                            } else {
                                document.getElementById('Razon_social').focus();
                            }
                        } 
                        else {
                            console.log("Consulta NO encontrada, Continúe Manualmente");
                            return;
                        }
                    }
                }
            </script>   
        </body>
    </html>