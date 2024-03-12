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
    $rutas = mysqli_query($conexion, "SELECT * FROM ruta WHERE CODIGO = '$cede'");
    $ruta = mysqli_fetch_assoc($rutas);
    $partida = $ruta['DIRECCION'];
    $abre = $ruta['ABREVIATURA'];
    $ruta2 = mysqli_query($conexion, "SELECT * FROM ruta");
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
        $liquidacion = date('d').date('m').date('Y').$abre;
    }
    $busca = mysqli_query($conexion, "SELECT * FROM datos_fijos WHERE LIQUIDACION = '$liquidacion'");
    $busca = mysqli_fetch_assoc($busca);
    if ($busca['CODIGO_CAMION']  != ""){
      $partes = explode("-", $busca['CODIGO_CAMION']);
      $marca = trim($partes[0]);
      $placa = trim($partes[1]);
      $camion = mysqli_query($conexion,"SELECT * FROM camiones WHERE PLACA= '$placa'");
      $camion = mysqli_fetch_assoc($camion);}
    if (isset($busca['LIQUIDACION']))
    {
        ?>
        <!DOCTYPE html>
            <html lang="es">
            <head>
            <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
                <link rel="stylesheet" href="Css/boleta.css">
                <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
                <meta charset="UTF-8">
                <title>Generación de Documentos</title>
            </head>
            <body>
              <div class="wrapper">
                <form class ="formulario" id="miFormulario" method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']); ?>">
                  <h1>Generación de Documentos</h1>
                    <div class="contenido">
                      <div class="contenido">
                        <div>
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
                          <a for="N° Doc">N° Doc :</a>
                          <input id="NDOC" type="text" oninput="validarCodigo(this)" name="NDOC" placeholder="" required style="width: 12ch;" onkeypress="return handleEnter(event, 'IGV')">
                          <button type="submit" class="btn" onclick="mostrarInterfaz(1)"><img id="image" src="img/buscar.png" alt="image" width="30px" height="30px"></button>
                            <div id="interfazBusqueda1" style="display: none;">
                              <iframe src="busca_prueba.php?tabla=VBUSCADOC&response=A&codi=BUSCA1" width="600" height="400" frameborder="0"></iframe>
                            </div>
                          <label for="fec.Emisión">fec.Emisión</label>
                          <input id="FECHA" type="date" name="FECHA" placeholder="Fecha" value ="<?php echo date('Y-m-d');?>" required style="width: 12ch;">
                          <a>I.G.V % </a>
                          <input id="IGV" type="number" name="IGV"  value ="<?php echo $igv ?? '';?>" oninput="validarIGV(this)" required style="width: 7.5ch;" max="100" onkeypress="return handleEnter(event, 'rucDni1')">
                        </div>
                        <div>
                          <label for="N° Doc">RUC/DNI :</label>
                          <input id="rucDni1" type="text" oninput="validarCodigo(this)" name="rucDni1" placeholder="" required >
                          <button type="submit" class="btn" onclick="mostrarInterfaz(2)"><img id="image" src="img/buscar.png" alt="image" width="30px" height="30px"></button>
                            <div id="interfazBusqueda2" style="display: none;">
                              <iframe src="busca_prueba.php?tabla=fmclinic&response=A&codi=BUSCA2" width="600" height="400" frameborder="0"></iframe>
                            </div>
                          <label for="N° Doc">Señor :</label>
                          <input id="nomb1" type="text" name="nomb1" placeholder="" required onkeypress="return handleEnter(event, 'dire1')">
                          <label for="N° Doc">Dirección :</label>
                          <input id="dire1" type="text" name="dire1" placeholder="" required onkeypress="return handleEnter(event, 'rucDni2')">
                        </div>
                      </div>
                      <div class="contenido">
                        <div class="contenido" style="display: inline-block">
                          <b><a>Remitente</a></b>
                          <br>
                            <label for="N° Doc">RUC/DNI :</label>
                            <input id="rucDni2" type="text" oninput="validarCodigo(this)" name="rucDni2" placeholder="" required style="width: 30ch;" >
                            <button type="submit" class="btn" onclick="mostrarInterfaz(3)"><img id="image" src="img/buscar.png" alt="image" width="30px" height="30px"></button>
                            <div id="interfazBusqueda3" style="display: none;">
                              <iframe src="busca_prueba.php?tabla=fmclinic&response=A&codi=BUSCA3" width="600" height="400" frameborder="0"></iframe>
                            </div>
                          <br>
                            <label>Nombres :</label>
                            <input id="nomb2" type="text" name="nomb2" placeholder="" required style="width: 30ch;" onkeypress="return handleEnter(event, 'dire2')">
                          <br>
                            <label>Dirección :</label>
                            <input id="dire2" type="text" name="dire2" placeholder="" required style="width: 30ch;" onkeypress="return handleEnter(event, 'rucDni3')">
                        </div>
                        <div class="contenido" style="display: inline-block">
                          <b><a>Cosignatario</a></b>
                          <br>
                            <label for="N° Doc">RUC/DNI :</label>
                            <input id="rucDni3" type="text" oninput="validarCodigo(this)" name="rucDni3" placeholder="" required style="width: 30ch;">
                            <button type="submit" class="btn" onclick="mostrarInterfaz(4)"><img id="image" src="img/buscar.png" alt="image" width="30px" height="30px"></button>
                            <div id="interfazBusqueda4" style="display: none;">
                              <iframe src="busca_prueba.php?tabla=fmclinic&response=A&codi=BUSCA4" width="600" height="400" frameborder="0"></iframe>
                            </div>
                          <br>
                            <label>Nombres :</label>
                            <input id="nomb3" type="text" name="nomb3" placeholder="" required style="width: 30ch;" onkeypress="return handleEnter(event, 'dire3')">
                          <br>
                            <label>Dirección :</label>
                            <input id="dire3" type="text" name="dire3" placeholder="" required style="width: 30ch;" oninput="actualizarValor(this.value)" onkeypress="return handleEnter(event, 'datosDestino')">
                        </div>
                        <div class="contenido" style="display: inline-block">
                          <b><a>Datos Destino</a></b>
                          <br>
                              <select name="datosDestino" id="datosDestino" onkeypress="return handleEnter(event, 'item')">
                                <option value="">-- SELECCIONE --</option>
                                <?php
                                  if ($ruta2) {
                                      while ($fila = mysqli_fetch_assoc($ruta2)) {
                                          echo "<option value='" . $fila['CODIGO'] . "' style='background-color: black; color: white;'>" . $fila['DESTINO'] .  "</option>";
                                      }
                                      mysqli_free_result($ruta2);
                                  } else {
                                      echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
                                  }
                                ?>   
                              </select>
                            <br>
                              <input type="checkbox" name="Dale" id="Dale1" onclick="toggleCheckboxes(this)">
                              <label for="miCheck1">Destino</label>
                            <br>
                              <input type="checkbox" name="Dale" id="Dale2" onclick="toggleCheckboxes(this)">
                              <label for="miCheck2">Oficina</label>                 
                        </div>
                      </div>
                    <div class="contenido">
                      <b><a>Datos - Identificaón de la Unidad y Conductor</a></b>
                      <br>
                      <label>Placa :</label>
                      <input id="placa" type="text"  name="placa" placeholder="" required value ="<?php echo $placa ?? '';?>" style="width: 8ch;">
                      <a>Direccion del Pto. de Partida. :</a>
                      <input id="punto_partida" type="text" name="punto_partida" placeholder="" required value ="<?php echo $busca['DIRECCION_PARTIDA'] ?? '';?>" style="width: 50ch;" readonly>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a>Fecha de Partida :</a>
                      <br>
                      <label>Marca :</label>
                      <input id="marca" type="text" name="marca" placeholder="" required value ="<?php echo $marca ?? ''?>" style="width: 8ch;">
                      <a>Direccion del Pto. de llegada :</a>
                      <input id="punto_llegada" type="text" name="punto_llegada" placeholder="" required value ="" style="width: 50ch;" readonly>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input id="fechaP" type="date" name="fechaP" placeholder="Fecha" value ="<?php echo $busca['FEC_TRANS'] ?? '';?>" required size="7">
                      <br>
                      <label>Certificado :</label>
                      <input id="cetificado" type="text" oninput="validarCodigo(this)" name="certificado" placeholder="" required value ="<?php echo $camion['CERTIFICADO'] ?? ''?>" style="width: 8ch;">
                      &nbsp;<a>Peso :</a>&nbsp;
                      <input id="peso" type="text" name="peso" placeholder="" required value ="<?php echo $camion['CARGA_MAXIMA'] ?? ''?>" style="width: 8ch;">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>Chofer :</a>
                      <select name="CHOFER" id ="miSelector" onchange = "change_chofer()" style="width: 50ch;">
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
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a>Hora de Partida :</a>
                      <br>
                      <label>Conf. V :</label>
                      <input id="conf" type="text" name="conf" placeholder="" required value ="<?php echo $camion['CONFIGURACION_VEHICULAR'] ?? ''?>" style="width: 8ch;">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>Lic :</a>&nbsp;
                      <input id="lic" type="text" name="lic" placeholder="" value = "<?php echo $busca['LIC'];?>" required style="width: 8ch;">
                      &nbsp;&nbsp;&nbsp;<a>Copiloto :</a>
                      <select name="COPI"  style="width: 50ch;">
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
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input id="fechaP" type="time" name="fechaP" placeholder="Hora" value ="<?php echo $busca['HORA_PARTIDA'] ?? '';?>" required size="7">
                    </div>
                    <div class="contenido">
                      <b><a>Ingrese datos a registrar en el detalle</a></b>
                      <br>                
                      <label style="text-align: left;">Descripción</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                      <a style="color:white ;border: 1px solid black; background-color: rgb(2, 12, 65); padding: 5px;">Cant</a>
                      <a style="color:white;border: 1px solid black; background-color: rgb(2, 12, 65); padding: 5px;">P.IGV</a>
                      <a style="color:white;border: 1px solid black; background-color: rgb(2, 12, 65); padding: 5px;">Total</a>


                      <br>
                      <input id="item" type="text" name="item" onkeypress="return handleEnter(event, 'cant')" placeholder="" required style="width: 91ch;">&nbsp;&nbsp;
                      <input id="cant" type="text" name="cant" onkeypress="return handleEnter(event, 'pigv')"oninput="validarCodigo(this)" required style="width: 5ch;">
                      <input id="pigv" type="text" name="pigv" oninput="validarCodigo(this)" required style="width: 5ch;">
                      <input id="total" type="text" name="total" oninput="validarCodigo(this)" required style="width: 5ch;">
                    </div>                           
                    <div class = "contenido" style="display: inline-block">
                      <button type="submit" name="guardar_datosfijos" class="btn"><img id="image" src="img/guardar.png" alt="image 1" width="30px" height="30px"></button>
                      <button type="submit" name="refrescar" class="btn"><img id="image" src="img/eliminar.png" alt="image 2" width="30px" height="30px"></button>
                      <button type="submit" name="volver" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/salir.png" alt="Image 4" width="30px" height="30px"></button>
                    </div>
                  </form>
                </div>
              </div>
                                                  
              <script>
                    function toggleCheckboxes(checkbox) {
                      var checkboxes = document.getElementsByName('Dale');
                      checkboxes.forEach(function(box) {
                        if (box !== checkbox) {
                          box.checked = false;
                        }
                      });
                    }
                    function actualizarValor(valor) {
                        document.getElementById('punto_llegada').value = valor;
                    }
                    function mostrarInterfaz(a) {
                      event.preventDefault(); // Evitar el envío del formulario por defecto
                        if(a===1){
                        document.getElementById("interfazBusqueda1").style.display = "block";
                        }
                        else if(a===2){
                        document.getElementById("interfazBusqueda2").style.display = "block";
                        }
                        else if(a===3){
                        document.getElementById("interfazBusqueda3").style.display = "block";
                        }
                        else if(a===4){
                        document.getElementById("interfazBusqueda4").style.display = "block";
                        }
                      
                    }
                    document.addEventListener('DOMContentLoaded', function() {
                        // Obtener el formulario
                        var form = document.getElementById('miFormulario');
                        // Agregar un controlador de eventos para prevenir el envío del formulario cuando se presiona Enter
                        form.addEventListener('keypress', function(event) {
                            if (event.keyCode === 13) { // Comprobar si se presionó la tecla Enter
                                event.preventDefault(); // Evitar el envío del formulario
                                return false;
                            }
                        });
                    });
                    function cerrarInterfaz(a) {
                        document.getElementById("interfazBusqueda1").style.display = "none";
                        document.getElementById("interfazBusqueda2").style.display = "none"; 
                        document.getElementById("interfazBusqueda3").style.display = "none";
                        document.getElementById("interfazBusqueda4").style.display = "none";     
                    }
                    window.addEventListener('message', function(event) {
                      if(event.data.id != ""){
                            document.getElementById('NDOC').value = event.data.id ?? "";
                        }
                        else if(event.data.rucdni1 != ""){
                            document.getElementById('rucDni1').value = event.data.rucdni1 ?? "";
                        }
                        else if(event.data.rucdni2 != ""){
                            document.getElementById('rucDni2').value = event.data.rucdni2 ?? "";
                        }
                        else if(event.data.rucdni3 != ""){
                            document.getElementById('rucDni3').value = event.data.rucdni3 ?? "";
                        }
                      }
                    );
                    function validarIGV(input) {
                      if (input.value > 100) {
                        input.value = 100; // Limita el valor máximo a 99
                      }
                      if (input.value < 0) {
                        input.value = 0; // Limita el valor máximo a 99
                      }
                    }
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
                                    document.getElementById('lic').value = response.licencia;            
                                } else {
                                        // Si el usuario no existe, solo da el foco
                                    document.getElementById('lic').value = "";
                                 }
                            }
                        };
                        xhr.send("miSelector=" + seleccion);
                        return false;
                    }
                    function dniruc(){
                      event.preventDefault();
                      if (event.keyCode === 13){
                        var dniruc = document.getElementById('rucDni').value;
                      }
                    }   

                    function ApiRucDni(dniruc) 
                    { 
                        var transacc = document.getElementById('transacc').value;
                        var xhr = new XMLHttpRequest();
                        var URLDNI = "proxy.php?numero=" + dniruc;
                        var URLRUC = "proxy.php?numero=" + dniruc;
                        
                        if (dniruc === 8) {
                            //URL = "http://api.apis.net.pe/v1/dni?numero=" + rucdni;
                            xhr.open("GET", URLDNI, true);
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 201)) {
                                    var responseData = JSON.parse(xhr.responseText);
                                    console.log(responseData);
                                    var nomb = responseData.nombre || ''; 
                                    var dire = responseData.direccion || 'Arequipa'; 
                                } else {
                                    console.log("NO SE ENCONTRO");
                                }
                            };
                            xhr.send();
                        } else if (ruc.length >= 11) {
                            if (dniruc === 11) {
                                //URL = "http://api.apis.net.pe/v1/ruc?numero=" + rucdni;
                                xhr.open("GET", URLRUC, true);
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 201)) {
                                        var responseData = JSON.parse(xhr.responseText);
                                        console.log(responseData);
                                        nomb = responseData.nombre || ''; 
                                        dire = responseData.direccion || 'Arequipa'; 
                                    } else {
                                        console.log("NO SE ENCONTRO");
                                    }
                                };
                                xhr.send();
                            } else {
                            }
                        } 
                        else {
                            console.log("Consulta NO encontrada, Continúe Manualmente");
                            return;
                        }
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
