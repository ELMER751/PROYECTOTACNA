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
    $condicion = mysqli_query($conexion, "SELECT * FROM CONDICIONES WHERE TIPDOC = '2'");
    $tran = mysqli_query($conexion, "SELECT CODI, DOCUMENTO AS NOMB FROM vuserdocu WHERE CODUSUARIO = '$user' AND codi NOT IN ('98', '99')");
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
<html lang="es">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Css/sd.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <title>Generación de Documentos</title>

</head>
<body>
  <div class="container">
    <form class="form" id="miFormulario" method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']); ?>">
      <div class="campo">
        <label for="CONDI">Condición :</label>
        <select name="CONDI" id="CONDI">
          <option value="">-- SELECCIONE --</option>
          <?php
            if ($condicion) {
                while ($fila = mysqli_fetch_assoc($condicion)) {
                    echo "<option value='" . $fila['CODI'] . "' style='background-color: black; color: white;'>" . $fila['NOMB'] .  "</option>";
                }
                mysqli_free_result($condicion);
            } else {
                echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
            }
          ?>   
        </select>
        <label for="TRANS">Transacc :</label>
        <select>
        <option value="">-- SELECCIONE --</option>
          <?php
            if ($tran) {
                while ($fila = mysqli_fetch_assoc($tran)) {
                    echo "<option value='" . $fila['CODI'] . "' style='background-color: black; color: white;'>" . $fila['NOMB'] .  "</option>";
                }
                mysqli_free_result($tran);
            } else {
                echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
            }
          ?>
        </select>    
        <label for="N° Doc">N° Doc :</label>
        <input id="NDOC" type="text" name="NDOC" placeholder="" required>
        <button type="submit" name="guar" class="boton"><img id="image" src="img/buscar.png" alt="image" width="20px" height="20px"></button>
        <label for="fec.Emisión">fec.Emisión</label>
        <input id="FECHA" type="date" name="FECHA" placeholder="Fecha" value ="<?php echo date('Y-m-d');?>" required size="7">
        <label for="TRANS">I.G.V % </label>
         
      </div>
      <div class="campo">
        <label for="FECHA">Fecha en Curso :</label>
        <input id="FECHA" type="text" name="FECHA" placeholder="Fecha" value ="<?php echo date('Y-m-d');?>" required readonly size="7">
      </div>
      <div class="campo">
        <label for="CAMION">Camión :</label>
        <select name="CAMION" id="CAMION">
           
        </select>
      </div>
      <div class="campo">
        <label for="CHOFER">Chofer :</label>
        <select name="CHOFER" id="CHOFER" onchange="change_chofer()">
          <option value="" <?php if($busca['CODIGO_CHOFER'] == "") echo 'selected' ; ?>>-- SELECCIONE --</option>
          <?php
            if ($chofer) {
                while ($fila = mysqli_fetch_assoc($chofer)) {
                    echo "<option value='" . $fila['USUARIO'] . "' style='background-color: black; color: white;' " . ($fila['USUARIO'] == $busca['CODIGO_CHOFER'] ? 'selected' : '') . " >" . $fila['NOMBRES'] . "</option>";
                }
                mysqli_free_result($chofer);
            } else {
                echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
            }
          ?>   
        </select>
      </div>
      <div class="campo">
        <label for="LICE">Licencia :</label>
        <input id="LICE" type="text" name="LICE" placeholder="Licencia" value = "<?php echo $busca['LIC'];?>" required readonly>
      </div>
      <div class="campo">
        <label for="COPI">Copiloto :</label>
        <select name="COPI" id="COPI">
          <option value="" <?php if($busca['CODIGO_COPILOTO'] == "") echo 'selected' ; ?>>-- SELECCIONE --</option>
          <?php
            if ($chof) {
                while ($fila = mysqli_fetch_assoc($chof)) {
                    echo "<option value='" . $fila['USUARIO'] . "' style='background-color: black; color: white;' " . ($fila['USUARIO'] == $busca['CODIGO_COPILOTO'] ? 'selected' : '') . ">" . $fila['NOMBRES'] . "</option>";
                }
                mysqli_free_result($chof);
            } else {
                echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
            }
          ?>   
        </select>
      </div>
      <div class="campo">
        <label for="LIQUIDADOR">Liquidador :</label>
        <select name="LIQUIDADOR" id="LIQUIDADOR">
          <option value="" <?php if($busca['CODIGO_LIQUIDADOR'] == "") echo 'selected' ;?>>-- SELECCIONE --</option>
          <?php
            if ($li) {
                while ($fila = mysqli_fetch_assoc($li)) {
                    echo "<option value='" . $fila['USUARIO'] . "' style='background-color: black; color: white;'" . ($fila['USUARIO'] == $busca['CODIGO_LIQUIDADOR'] ? 'selected' : '') . ">" . $fila['NOMBRES'] . "</option>";
                }
                mysqli_free_result($li);
            } else {
                echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
            }
          ?>   
        </select>
      </div>
      <div class="campo">
        <label for="FECHA_PARTIDA">Fecha Partida :</label>
        <input id="FECHA_PARTIDA" style="appearance: none; -webkit-appearance: none;" type="date" name="FECHA_PARTIDA" placeholder="Fecha" value ="<?php echo $busca['FECHA_PARTIDA'];?>" required size="7">
      </div>
      <div class="campo">
        <label for="HORA">Hora Partida :</label>
        <input id="HORA" type="time" name="HORA" placeholder="Hora" value="<?php date_default_timezone_set('America/Lima'); echo $busca['HORA_PARTIDA'];?>" required size="2.5">
      </div>
      <div class="campo">
        <label for="PARTIDA">Partida :</label>
        <input id="PARTIDA" type="text" name="PARTIDA" placeholder="PARTIDA" value ="<?php echo $partida;?>" required readonly >
      </div>
      <div>
        <button type="submit" name="guardar_datosfijos" class="boton"><img id="image" src="img/guardar.png" alt="image 1" width="30px" height="30px"></button>
        <button type="submit" name="refrescar" class="boton"><img id="image" src="img/eliminar.png" alt="image 2" width="30px" height="30px"></button>
        <button type="submit" name="volver" class="boton" onclick="submitFormWithoutRequired()"><img id="image" src="img/salir.png" alt="Image 4" width="30px" height="30px"></button>
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
        echo "<script>
                alert('Ingrese Datos - Identificaón de la Unidad y Conductor de Hoy - Para Poder Generar Documentos');
                window.location.href = 'd_viaje.php';
                </script>";
        mysqli_close($conexion);
    }  
    ?>
