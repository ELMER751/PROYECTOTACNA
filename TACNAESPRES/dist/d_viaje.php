<?php
//include_once('header.php');

?>
<?php
session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: ingresar_sesion.php");
        exit();
        }
    include_once('includes/acceso.php');
    $conexion = connect_db();
    $ultimo_codigo = mysqli_query($conexion, "SELECT MAX(CODI) AS ultimo_codigo FROM condiciones");
    $ultimo_codigo = mysqli_fetch_assoc($ultimo_codigo);
    $ultimo_codigo = $ultimo_codigo["ultimo_codigo"];
    $fec_trans = date('Y-m-d');
    $user = $_SESSION["username"];
    $cede = mysqli_query($conexion, "SELECT * FROM fuser WHERE USUARIO = '$user'");
    $cede = mysqli_fetch_assoc($cede);
    $cede = $cede['CEDE'];
    $ruta = mysqli_query($conexion, "SELECT * FROM ruta WHERE CODIGO = '$cede'");
    $ruta = mysqli_fetch_assoc($ruta);
    $partida = $ruta['DIRECCION'];
    $ruta = $ruta['ABREVIATURA'];
    $liquidacion = mysqli_query($conexion, "SELECT * FROM DATOS_FIJOS WHERE FEC_TRANS = '$fec_trans' AND CEDE = '$cede'");
    $liquidacion = mysqli_fetch_assoc($liquidacion);
    $resultado = mysqli_query($conexion, "SELECT CONCAT(MARCA, ' - ', PLACA) AS CAMIONX FROM camiones ORDER BY CODIGO");
    $chofer = mysqli_query($conexion, "SELECT * FROM FUSER WHERE OCUPACION  = 'CHOFER' ORDER BY NOMBRES ASC");
    $chof = mysqli_query($conexion, "SELECT * FROM FUSER WHERE OCUPACION  = 'CHOFER' ORDER BY NOMBRES ASC"); 
    $li = mysqli_query($conexion, "SELECT * FROM FUSER WHERE OCUPACION  = 'SECRETARIA' ORDER BY NOMBRES ASC");
    if (isset($liquidacion['LIQUIDACION'])) {
        $liquidacion = $liquidacion['LIQUIDACION'];
    } else {
        $liquidacion = date('d').date('m').date('Y').$ruta;
    }
    $busca = mysqli_query($conexion, "SELECT * FROM datos_fijos WHERE LIQUIDACION = '$liquidacion'");
    $busca = mysqli_fetch_assoc($busca);
    if (isset($busca['LIQUIDACION']))
    {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
            <title>DATOS FIJOS</title>
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
                        <h1>IDENTIFICACIÓN DE LA  <br> UNIDAD Y CONDUCTOR</h1>
                        <div  class="entrada">
                            <p>Liquidación :</p>
                            <input id="LIQUI" type="text" name="LIQUI" placeholder="Liquidación" value ="<?php echo $liquidacion;?>" required readonly  size="9">
                            <p>Fecha en Curso :</p>
                            <input id="FECHA" type="text" name="FECHA" placeholder="Fecha" value ="<?php echo date('Y-m-d');?>" required readonly size="7">
                        </div>
                        <div class="input-box">
                            <p>Camión :</p>
                            <select name="CAMION"  style="flex: 1; margin-right: 10px; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px;">
                                <option value="" <?php if($busca['CODIGO_CAMION'] == "") echo 'selected' ; ?>>-- SELECCIONE --</option>
                                <?php
                                    // Iterar sobre los resultados de la consulta y generar opciones para el elemento de selección
                                    if ($resultado) {
                                        while ($fila = mysqli_fetch_assoc($resultado)) {
                                            echo "<option value='" . $fila['CAMIONX'] . "' style='background-color: black; color: white;' " . ($fila['CAMIONX'] == $busca['CODIGO_CAMION'] ? 'selected' : '') . " >" . $fila['CAMIONX'] .  "</option>";
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
                        <div class="input-box">
                            <p>Chofer :</p>
                            <select name="CHOFER" id ="miSelector" onchange = "change_chofer()" style="flex: 1; margin-right: 10px; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px;">
                            <option value="" <?php if($busca['CODIGO_CHOFER'] == "") echo 'selected' ; ?>>-- SELECCIONE --</option>
                                <?php
                                    // Iterar sobre los resultados de la consulta y generar opciones para el elemento de selección
                                    if ($chofer) {
                                        while ($fila = mysqli_fetch_assoc($chofer)) {
                                            echo "<option value='" . $fila['USUARIO'] . "' style='background-color: black; color: white;' " . ($fila['USUARIO'] == $busca['CODIGO_CHOFER'] ? 'selected' : '') . " >" . $fila['NOMBRES'] . "</option>";
                                        }
                                        // Liberar el resultado
                                        mysqli_free_result($chofer);
                                    } else {
                                        // Si la consulta falla, mostrar un mensaje de error
                                        echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
                                    }
                                ?>   
                            </select>
                        </div>
                        <div class="input-box">
                            <p>Licencia :</p>
                            <input id="LICE" type="text" name="LICE" placeholder="Licencia" value = "<?php echo $busca['LIC'];?>" required readonly>
                        </div>
                        <div style="display: flex;">
                            <p>Copiloto :</p>
                            <select name="COPI"  style="flex: 1; margin-right: 10px; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px;">
                            <option value="" <?php if($busca['CODIGO_COPILOTO'] == "") echo 'selected' ; ?>>-- SELECCIONE --</option>
                                <?php
                                    // Iterar sobre los resultados de la consulta y generar opciones para el elemento de selección
                                    if ($chof) {
                                        while ($fila = mysqli_fetch_assoc($chof)) {
                                            echo "<option value='" . $fila['USUARIO'] . "' style='background-color: black; color: white;' " . ($fila['USUARIO'] == $busca['CODIGO_COPILOTO'] ? 'selected' : '') . ">" . $fila['NOMBRES'] . "</option>";
                                        }
                                        // Liberar el resultado
                                        mysqli_free_result($chof);
                                    } else {
                                        // Si la consulta falla, mostrar un mensaje de error
                                        echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
                                    }
                                ?>   
                            </select>
                        </div>
                        <div class="input-box">
                            <p>Liquidador :</p>
                            <select name="LIQUIDADOR" style="flex: 1; margin-right: 10px; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px;">
                            <option value="" <?php if($busca['CODIGO_LIQUIDADOR'] == "") echo 'selected' ;?>>-- SELECCIONE --</option>
                                <?php
                                    // Iterar sobre los resultados de la consulta y generar opciones para el elemento de selección
                                    if ($li) {
                                        while ($fila = mysqli_fetch_assoc($li)) {
                                            echo "<option value='" . $fila['USUARIO'] . "' style='background-color: black; color: white;'" . ($fila['USUARIO'] == $busca['CODIGO_LIQUIDADOR'] ? 'selected' : '') . ">" . $fila['NOMBRES'] . "</option>";
                                        }
                                        // Liberar el resultado
                                        mysqli_free_result($li);
                                    } else {
                                        // Si la consulta falla, mostrar un mensaje de error
                                        echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
                                    }
                                ?>   
                            </select>
                        </div>
                        <div class="entrada" >
                            <p>Fecha Partida :</p>
                            <input id="FECHA_PARTIDA" style="appearance: none; -webkit-appearance: none;" type="date" name="FECHA_PARTIDA" placeholder="Fecha" value ="<?php echo $busca['FECHA_PARTIDA'];?>" required size="7">
                            <p>Hora Partida :</p>
                            <input id="HORA" type="time" name="HORA" placeholder="Hora" value="<?php date_default_timezone_set('America/Lima'); echo $busca['HORA_PARTIDA'];?>" required size="2.5">
                            </div>
                        <div class="entrada">
                            <p>Partida :</p>
                            <input id="PARTIDA" type="text" name="PARTIDA" placeholder="PARTIDA" value ="<?php echo $partida;?>" required readonly >
                        </div>
                        <div style="display: flex;">
                            <button type="submit" name="guardar_datosfijos" class="btn"><img id="image" src="img/guardar.png" alt="image 1" width="70px" height="70px"></button>
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
                    function change_chofer() {
                        var seleccion = document.getElementById("miSelector").value;
                        // Hacer algo con la selección, por ejemplo, mostrarla en la consola
                        console.log("Seleccionaste: " + seleccion);
                    // Realizar la solicitud AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "consultas/chofer.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                var response = JSON.parse(xhr.responseText);
                                if (response.mensaje === "existe") {
                                    document.getElementById('LICE').value = response.licencia;            
                                } else {
                                        // Si el usuario no existe, solo da el foco
                                    document.getElementById('LICE').value = "";
                                 }
                            }
                        };
                        xhr.send("miSelector=" + seleccion);
                        return false;
                    }
                </script>
            </body>
        </html>
        <?php
        mysqli_close($conexion);
    }
    else
    {
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
                        <h1>IDENTIFICACIÓN DE LA <br> UNIDAD Y CONDUCTOR</h1>
                        <div  class="entrada">
                            <p>Liquidación :</p>
                            <input id="LIQUI" type="text" name="LIQUI" placeholder="Liquidación" value ="<?php echo $liquidacion;?>" required readonly  size="9">
                            <p>Fecha en Curso :</p>
                            <input id="FECHA" type="text" name="FECHA" placeholder="Fecha" value ="<?php echo date('d-m-Y');?>" required readonly size="7">
                        </div>
                        <div class="input-box">
                            <p>Camión :</p>
                            <select name="CAMION"  style="flex: 1; margin-right: 10px; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px;">
                                <option value="" selected>-- SELECCIONE --</option>
                                <?php
                                    // Iterar sobre los resultados de la consulta y generar opciones para el elemento de selección
                                    if ($resultado) {
                                        while ($fila = mysqli_fetch_assoc($resultado)) {
                                            echo "<option value='" . $fila['CAMIONX'] . "' style='background-color: black; color: white;'>" . $fila['CAMIONX'] . "</option>";
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
                        <div class="input-box">
                            <p>Chofer :</p>
                            <select name="CHOFER" id ="miSelector" onchange = "change_chofer()" style="flex: 1; margin-right: 10px; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px;">
                            <option value="" selected>-- SELECCIONE --</option>
                                <?php
                                    // Iterar sobre los resultados de la consulta y generar opciones para el elemento de selección
                                    if ($chofer) {
                                        while ($fila = mysqli_fetch_assoc($chofer)) {
                                            echo "<option value='" . $fila['USUARIO'] . "' style='background-color: black; color: white;'>" . $fila['NOMBRES'] . "</option>";
                                        }
                                        // Liberar el resultado
                                        mysqli_free_result($chofer);
                                    } else {
                                        // Si la consulta falla, mostrar un mensaje de error
                                        echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
                                    }
                                ?>   
                            </select>
                        </div>
                        <div class="input-box">
                            <p>Licencia :</p>
                            <input id="LICE" type="text" name="LICE" placeholder="Licencia" required readonly>
                        </div>
                        <div style="display: flex;">
                            <p>Copiloto :</p>
                            <select name="COPI"  style="flex: 1; margin-right: 10px; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px;">
                            <option value="" selected>-- SELECCIONE --</option>
                                <?php
                                    // Iterar sobre los resultados de la consulta y generar opciones para el elemento de selección
                                    if ($chof) {
                                        while ($fila = mysqli_fetch_assoc($chof)) {
                                            echo "<option value='" . $fila['USUARIO'] . "' style='background-color: black; color: white;'>" . $fila['NOMBRES'] . "</option>";
                                        }
                                        // Liberar el resultado
                                        mysqli_free_result($chof);
                                    } else {
                                        // Si la consulta falla, mostrar un mensaje de error
                                        echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
                                    }
                                ?>   
                            </select>
                        </div>
                        <div class="input-box">
                            <p>Liquidador :</p>
                            <select name="LIQUIDADOR" id ="miSelector" onchange = "change_chofer()" style="flex: 1; margin-right: 10px; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px;">
                            <option value="" selected>-- SELECCIONE --</option>
                                <?php
                                    // Iterar sobre los resultados de la consulta y generar opciones para el elemento de selección
                                    if ($li) {
                                        while ($fila = mysqli_fetch_assoc($li)) {
                                            echo "<option value='" . $fila['USUARIO'] . "' style='background-color: black; color: white;'>" . $fila['NOMBRES'] . "</option>";
                                        }
                                        // Liberar el resultado
                                        mysqli_free_result($li);
                                    } else {
                                        // Si la consulta falla, mostrar un mensaje de error
                                        echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
                                    }
                                ?>   
                            </select>
                        </div>
                        <div class="entrada" >
                            <p>Fecha Partida :</p>
                            <input id="FECHA_PARTIDA" style="appearance: none; -webkit-appearance: none;" type="date" name="FECHA_PARTIDA" placeholder="Fecha" value ="<?php echo date('Y-m-d');?>" required size="7">
                            <p>Hora Partida :</p>
                            <input id="HORA" type="time" name="HORA" placeholder="Hora" value="<?php date_default_timezone_set('America/Lima'); echo date('H:i:s');?>" required size="2.5">
                            </div>
                        <div class="entrada">
                            <p>Partida :</p>
                            <input id="PARTIDA" type="text" name="PARTIDA" placeholder="PARTIDA" value ="<?php echo $partida;?>" required readonly >
                        </div>
                        <div style="display: flex;">
                            <button type="submit" name="guardar_datosfijos" class="btn"><img id="image" src="img/guardar.png" alt="image 1" width="70px" height="70px"></button>
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
                    function change_chofer() {
                        var seleccion = document.getElementById("miSelector").value;
                        // Hacer algo con la selección, por ejemplo, mostrarla en la consola
                        console.log("Seleccionaste: " + seleccion);
                    // Realizar la solicitud AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "consultas/chofer.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                var response = JSON.parse(xhr.responseText);
                                if (response.mensaje === "existe") {
                                    document.getElementById('LICE').value = response.licencia;            
                                } else {
                                        // Si el usuario no existe, solo da el foco
                                    document.getElementById('LICE').value = "";
                                }
                            }
                        };
                        xhr.send("miSelector=" + seleccion);
                        return false;
                    }
                </script>
            </body>
        </html>
        <?php   
        mysqli_close($conexion);
        }
    ?>
