<?php
session_start();
if (!isset($_SESSION["username"])) {header("Location: ingresar_sesion.php");exit();}
?>
<?php
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
                        <p>RUC/DNI :</p>
                        <input id="Ruc_dni" type="text" name="Ruc_dni" placeholder="RUC/DNI" autofocus required onkeypress="return ApiRucDni()">
                    </div>
                    <div class="input-box">
                        <p>Razón social :</p>
                        <input id="Razon_social" type="text" name="Razon_social" placeholder="Razón Social" required onkeypress="return handleEnter(event, 'Nombre')">
                    </div>
                    <div class="input-box">
                        <p>Nombre :</p>
                        <input id="Nombre" type="text" name="Nombre" placeholder="Nombre" required onkeypress="return handleEnter(event, 'Direccion')">
                    </div>
                    <div class="input-box">
                        <p>Dirección :</p>
                        <input id="Direccion" type="text" name="Direccion" placeholder="Dirección" required>
                    </div>
                    <div class="input-box">
                        <button type="submit" name="correcto" class="btn" onclick="RD()"><img id="image" src="img/aceptar.png" alt="Image 1" width="70px" height="70px"></button>
                        <button type="submit" name="refrescar" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/eliminar.png" alt="Image 2" width="70px" height="70px"></button>
                        <button type="submit" name="volver" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/salir.png" alt="Image 3" width="70px" height="70px"></button>
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

                function ApiRucDni() {
                    if (event.keyCode === 13) { 
                        event.preventDefault();
                        var rucdni = document.getElementById('Ruc_dni').value; 
                        var xhr = new XMLHttpRequest();
                        var URL = "proxy.php?numero=" + rucdni;
                        
                        if (rucdni.length === 8) {
                            //URL = "http://api.apis.net.pe/v1/dni?numero=" + rucdni;
                            xhr.open("GET", URL, true);
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 201)) {
                                    var responseData = JSON.parse(xhr.responseText);
                                    console.log(responseData);
                                    document.getElementById('Nombre').value = responseData.nombre || ''; 
                                    document.getElementById('Direccion').value = responseData.direccion || 'Arequipa'; 
                                    document.getElementById('Nombre').focus();
                                } else {
                                    console.log("Error de conexión con el servidor");
                                }
                            };
                            xhr.send();
                        } else if (rucdni.length >= 11) {
                            if (rucdni.length === 11) {
                                //URL = "http://api.apis.net.pe/v1/ruc?numero=" + rucdni;
                                xhr.open("GET", URL, true);
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 201)) {
                                        var responseData = JSON.parse(xhr.responseText);
                                        console.log(responseData);
                                        document.getElementById('Razon_social').value = responseData.nombre || ''; 
                                        document.getElementById('Direccion').value = responseData.direccion || 'Arequipa'; 
                                        document.getElementById('Razon_social').focus();
                                    } else {
                                        console.log("Error de conexión con el servidor");
                                    }
                                };
                                xhr.send();
                            } else {
                                document.getElementById('Razon_social').focus();
                            }
                        } else {
                            console.log("Consulta NO encontrada, Continúe Manualmente");
                            return;
                        }
                    }
                }
                function submitFormWithoutRequired() {
                    var requiredInputs = document.querySelectorAll('input[required]');
                    requiredInputs.forEach(function(input) {
                        input.removeAttribute('required');
                    });
                    document.getElementById('miFormulario').submit();
                }

                function RD()
                {
                    var rucdni = document.getElementById('Ruc_dni').value; 
                    if (rucdni.length < 9){
                        document.getElementById('Razon_social').removeAttribute('required'); 
                    }
                    else{
                        document.getElementById('Nombre').removeAttribute('required');
                    }
                }

            </script>
        </body>
    </html>