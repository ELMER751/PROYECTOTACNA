<?php
include_once('header.php');
?>
<?php

//session_start();
date_default_timezone_set('America/Lima');
    //if (!isset($_SESSION["username"])) {
      //  header("Location: ingresar_sesion.php");
      //  exit();
       // }
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
    $documentos= mysqli_query($conexion,"SELECT MAX(DOC1) AS ultimo_codigo FROM fcabecer"); 
    $documentos = mysqli_fetch_assoc($documentos);
    $ultimo_codigo = $documentos["ultimo_codigo"];
    $motivo = mysqli_query($conexion, "SELECT * FROM MOTIVONC");
    if (isset($liquidacion['LIQUIDACION'])) {
        $liquidacion = $liquidacion['LIQUIDACION'];
    } else {
        $liquidacion = date('d').date('m').date('Y').$abre;
    }
    $busca = mysqli_query($conexion, "SELECT * FROM datos_fijos WHERE LIQUIDACION = '$liquidacion'");
    $busca = mysqli_fetch_assoc($busca);
    if (isset($busca['CODIGO_CAMION'])){
      $partes = explode("-", $busca['CODIGO_CAMION']);
      $marca = trim($partes[0]);
      $placa = trim($partes[1]);
      $camion = mysqli_query($conexion,"SELECT * FROM camiones WHERE PLACA= '$placa'");
      $camion = mysqli_fetch_assoc($camion);}
        ?>
        <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="Css/boleta.css">
                <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
                <script src="js/funciones.js"></script>
                <meta charset="UTF-8">
                <title>Note de Credito</title>
            </head>
            <style>
              
              table {
                  border-collapse: collapse;
                  width: 100%;
              }
              th, td {
                  border: 2px solid rgba(0, 0, 0, 0.897);
                  text-align: left;
                  padding: 8px;
              }
              th {
                background-color: rgba(83, 80, 80, 0.562);
                
              }
              td{
                background-color: white;
              }
              
              .eliminar:hover {
                  /* Estilos para cuando el botón se pasea por encima */
                  background-color: #138496;
                  border-color: #117a8b;
                  color: white;
              }
              .eliminar {
              cursor: pointer;
              border-radius: 5px;
              background-color: red;
              color: white;
              border: 1px solid black;
              
              }
              .styled-div {
                  background-color: white;
                  border: 1px solid black;
                  padding: 20px; /* Espacio interior */
                  margin: 20px;  /* Espacio exterior */
              }
              input[readonly] {
              background-color: lightgray; /* Cambia el fondo a gris claro */
                
              }           
              #customMsgBox {
                      display: none;
                      position: fixed;
                      left: 50%;
                      top: 50%;
                      transform: translate(-50%, -50%);
                      width: 300px;
                      padding: 20px;
                      background-color: white;
                      border: 1px solid #ccc;
                      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                      z-index: 1000;
                  }
                  #customMsgBox .title {
                      font-weight: bold;
                      margin-bottom: 10px;
                  }
                  #customMsgBox .message {
                      margin-bottom: 20px;
                  }
                  #customMsgBox .buttons {
                      text-align: right;
                  }
                  #customMsgBox .buttons button {
                      margin-left: 10px;
                  }
                  #overlay {
                      display: none;
                      position: fixed;
                      left: 0;
                      top: 0;
                      width: 100%;
                      height: 100%;
                      background-color: rgba(0, 0, 0, 0.5);
                      z-index: 999;
                  }
            </style>
            <body>
                <div class="wrapper">
                  <form class ="formulario" id="miFormulario" method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']); ?>">
                  <br>  
                  <h1>Nota De Credito</h1>
                      <div class="contenido">
                        <div class="contenido">
                          <div>    
                            <label>N° Nota :</label>
                            <input id="NDOCNOTA" type="text" name="NDOCNOTA" style="width: 12ch;" readonly>
                            <button type="submit" class="btn" onclick="mostrarInterfaz(1)"><img id="image" src="img/buscar.png" alt="image" width="20px" height="20px"></button>
                              <div id="interfazBusqueda1" style="width: 100%; height: 100vh; position: fixed; top: 0; left: 0; background-color: rgba(144, 148, 150, 0.8); display: none; justify-content: center; align-items: center; z-index: 100;">
                                <iframe src="busca_prueba.php?tabla=VBUSCADOCNOT&response=A&codi=BUSCA5" width="1100" height="300" frameborder="0" style="border: 2px solid rgba(12, 12, 12, 0.2);border-radius: 40px;"></iframe>
                              </div>
                              <label>Transacc :</label>
                            <select style="width: 16ch;" id ="trans" name ="trans">
                                <option value="">NOTA CRED - TAC</option>
                            
                            </select>
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            <label>fec.Emisión</label>
                            <input id="FECHA" type="date" name="FECHA" placeholder="Fecha" value ="<?php echo date('Y-m-d');?>" required style="width: 12ch;">
                           <a>I.G.V % </a>
                            <input id="IGV" type="number" name="IGV"  value ="<?php echo $igv ?? '18';?>" oninput="validarIGV(this)" required style="width: 7.5ch; text-align: right;" max="100" onkeypress="return handleEnter(event, 'rucDni1')">
                          </div>
                        </div>
                        <div class="contenido">
                          <div class="contenido">
                            <b><a>Datos del Documento</a></b>
                            <br>
                            <label>Transacc :</label>
                            <select style="width: 16ch;" id ="transs" name ="transs">
                            <option value="">SELECCIONE</option>
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
                            <label>N° Doc :</label>
                            <input id="NDOC" type="text" name="NDOC" style="width: 12ch;" readonly>
                            <button type="submit" class="btn" onclick="mostrarInterfaz(2)"><img id="image" src="img/buscar.png" alt="image" width="20px" height="20px"></button>
                              <div id="interfazBusqueda2" style="width: 100%; height: 100vh; position: fixed; top: 0; left: 0; background-color: rgba(144, 148, 150, 0.8); display: none; justify-content: center; align-items: center; z-index: 100;">
                                <iframe src="busca_prueba.php?tabla=VBUSCADOC&response=A&codi=BUSCA1" width="1100" height="300" frameborder="0" style="border: 2px solid rgba(12, 12, 12, 0.2);border-radius: 40px;"></iframe>
                              </div>
                              <div id="overlay"></div>
                              <div id="customMsgBox" style="display: none">
                                  <div class="title" id="msgBoxTitle">Alerta</div>
                                  <div class="message" id="msgBoxMessage">Documento Ya Esta Asociado a Nota de Credito, Verifique</div>
                                  <div class="buttons">
                                      <button onclick="closeCustomMsgBox()">Aceptar</button>
                                  </div>
                              </div>
                              <label>fec.Emisión</label>
                            <input id="FECHAA" type="date" name="FECHAA" placeholder="Fecha" value ="<?php echo date('Y-m-d');?>" readonly style="width: 12ch;">                 
                                <label>Señor :</label>
                                <input readonly id="nomb1" type="text" name="nomb1" placeholder="" required style="width: 30ch;" onkeypress="return handleEnter(event, 'dire2')">
                                <br>
                                <label>Dirección :</label>
                                <input readonly id="dire1" type="text" name="dire1" placeholder="" required style="width: 30ch;" onkeypress="return handleEnter(event, 'CONDI')">
                            
                                <label>Condición :</label>
                                <select style="width: 16ch;" name="CONDI" id="CONDI">
                                <option value="">SELECCIONE</option>
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
                                <label id="label1">RUC/DNI :</label>
                                <input readonly id="rucDni1" type="text" oninput="validarCodigo(this)" onkeypress="return dniruc(1)" name="rucDni1" required >
                                <br>
                                <label>Motivo devolución :</label>
                                <select style="width: 45ch;" id ="motivodev" name ="motivodev">
                                <option value=""></option>
                                  <?php
                                    if ($motivo) {
                                        while ($fila = mysqli_fetch_assoc($motivo)) {
                                            echo "<option value='" . $fila['CODMNC'] . "' style='background-color: black; color: white;'>" . $fila['MOTIVONC'] .  "</option>";
                                        }
                                        mysqli_free_result($motivo);
                                    } else {
                                        echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
                                    }
                                  ?>
                                </select>
                            </div>
                            <div class="styled-div">
                              <div id="grillaContainer1">
                                <table id="grilla1">
                                    <thead>
                                        <tr>
                                            <th>ITEM</th>
                                            <th>Descripción</th>
                                            <th>Cantidad</th>
                                            <th>Precio.IGV</th>
                                            <th>PrecioTotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="grillaBody1" >
                                    
                                    </tbody>
                                    </table>
                              </div>
                            </div>          
                      <div class="contenido">
                        <b><a>Ingrese datos a registrar en el detalle</a></b>
                        <br>                
                        <label style="text-align: left;">Descripción</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                        <a style="color:white ;border: 1px solid black; background-color: rgb(2, 12, 65); padding: 5px;">Sub-T </a>
                        <a style="color:white;border: 1px solid black; background-color: rgb(2, 12, 65); padding: 5px;">IGV </a>
                        <a style="color:white;border: 1px solid black; background-color: rgb(2, 12, 65); padding: 5px;">T-Ve </a>
                        <a style="color:white;border: 1px solid black; background-color: rgb(2, 12, 65); padding: 5px;">T-NC </a>
                        <br>
                        <input id="item" type="text" name="item" onkeypress="return total_compra()"  placeholder="" style="width: 91ch;">&nbsp;&nbsp;
                        <input id="cant" type="text" name="cant" onkeypress="" readonly oninput="validarCodigo(this)" style="width: 5ch;">
                        <input id="pigv" type="text" name="pigv" readonly oninput="validarCodigo(this)" style="width: 5ch;">
                        <input id="total" type="text" name="total"  readonly oninput="validarCodigo(this)" style="width: 5ch;">
                        <input id="pNC" type="text" name="pNC" onkeypress = "return handleEnter(event, 'btnAgregarItem')" oninput="validarCodigo(this)" style="width: 5ch;">
                        <button type="button" id="btnAgregarItem" onkeypress=" btnAgregarItem.click()">Agregar </button>
                        <div class="styled-div">
                          <div id="grillaContainer">
                              <table id="grilla">
                                  <thead>
                                      <tr>
                                          <th>ITEM</th>
                                          <th>Descripción</th>
                                          <th>Cantidad</th>
                                          <th>Precio.IGV</th>
                                          <th>PrecioTotal</th>
                                      </tr>
                                  </thead>
                                  <tbody id="grillaBody" >
                                  
                                  </tbody>
                                  </table>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div id="letras" style="display: none;">
                        <a id="total_ventaEnLetras" name='total_ventaEnLetras'></a>
                        </div>
                      <div style="display: inline-block">
                        <div class = "contenido" style="display: inline-block">
                          <button type="submit" name="guarda_documento" onclick="tabla()" onkeypress="image1.click()" class="btn" id="image1" ><img src="img/guardar.png" alt="image 1" width="30px" height="30px"></button>
                          <button type="submit" name="refrescar" class="btn" onclick="submitFormWithoutRequired()"><img id="image2" src="img/eliminar.png" alt="image 2" width="30px" height="30px"></button>
                          <button type="submit" name="volver" class="btn" onclick="submitFormWithoutRequired()"><img id="image3" src="img/salir.png" alt="Image 4" width="30px" height="30px"></button>
                        </div>
                      &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                        <div class = "contenido" style="display: inline-block ">
                        <a>USER</a>
                        <br>
                          <label style="font-size: 10px;">Usuario :</label>
                          <input id="pass" type="password" name="pass" onkeypress="confirmaruser(event)" required style="width: 10ch;font-size: 10px;" >
                          <input id="user" type="text" name="user"  required style="width: 10ch;font-size: 10px;" readonly>
                          <br>
                          <label style="font-size: 10px;">Fec/Hora :</label>
                          <input id="fech" type="text" name="fech" required style="width: 10ch;font-size: 10px;" readonly>
                          <input id="hor" type="text" name="hor"  required style="width: 10ch;font-size: 10px;" readonly>
                        </div>
                        <div class = "contenido" style="display: inline-block">
                        <label>Sub-Total :</label>
                        <input id="subtotal" style="text-align: right; width: 7ch;" type="text" name="subtotal" onkeypress="return handleEnter(event, 'pigv')" oninput="validarCodigo(this)" required readonly>
                        <br>
                        <label>IGV :</label>
                        <input id="igv_venta" type="text" name="igv_venta" onkeypress = "return total_compra()" oninput="validarCodigo(this)" required style="width: 7ch;text-align: right;" readonly>
                        <br>
                        <label>Total Venta :</label>
                        <input id="total_venta" type="text" name="total_venta" readonly oninput="validarCodigo(this)" required style="width: 7ch;text-align: right;" readonly>
                        <input type="hidden" name="datos_tabla_nota" id="datos_tabla_nota">
                        <input type="hidden" name="letras" id="letrass">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>                                    
              <script>
  
                function hola(){
                  var ndoc = document.getElementById('NDOC').value;
                  return ndoc;
                }

                function tabla(){  
                  document.getElementById("miFormulario").addEventListener("submit", function(event) {
                    event.preventDefault(); // Evitar el envío del formulario por defecto
                    // Obtener los datos de la tabla y convertirlos a un objeto JSON
                    var datosTabla = [];
                    var filas = document.getElementById("grillaBody").querySelectorAll("tr");
                    filas.forEach(function(fila) {
                        var filaData = {
                            item: fila.cells[0].innerText,
                            descripcion: fila.cells[1].innerText,
                            cantidad: fila.cells[2].innerText,
                            precio_igv: fila.cells[3].innerText,
                            precio_total: fila.cells[4].innerText
                        };
                        datosTabla.push(filaData);
                    });

                    // Convertir el objeto JSON a una cadena y asignarlo al campo oculto
                    document.getElementById("datos_tabla_nota").value = JSON.stringify(datosTabla);
                    // Enviar el formulario
                    this.submit();
                  });}

                function confirmaruser(event){
                  if (event.keyCode === 13) {
                    event.preventDefault(); // Evitar el envío del formulario
                    var pass = document.getElementById("pass").value;

                    // Realizar la solicitud AJAX
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "verifica.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.respuesta === "Contraseña correcta") {
                                // Si el usuario existe, borra el campo y da el foco
                                alert(response.respuesta); // Mostrar respuesta en una alerta (solo para depuración)
                                document.getElementById("user").value = response.user || "";
                                document.getElementById("fech").value = document.getElementById("FECHA").value;
                                var now = new Date();
                                var hours = now.getHours() < 10 ? '0' + now.getHours() : now.getHours();
                                var minutes = now.getMinutes() < 10 ? '0' + now.getMinutes() : now.getMinutes();
                                var seconds = now.getSeconds() < 10 ? '0' + now.getSeconds() : now.getSeconds();
                                var horaActual = hours + ":" + minutes + ":" + seconds;
                                document.getElementById("hor").value = horaActual;
                                document.getElementById("image1").focus();
                              } else {
                                alert(response.respuesta);
                                // Si el usuario no existe, solo da el foco
                                document.getElementById("pass").focus();
                                document.getElementById("pass").value = "";
                                document.getElementById("user").value = "";
                                document.getElementById("fech").value = "";
                                document.getElementById("hor").value = "";
                                
                            }
                        }
                    };
                    xhr.send("pass=" + pass);
                    return false; // Evitar la propagación del evento
                  }
                }
                
                function calcularTotales() {
                    var subtotal = 0;
                    var igv = 0;
                    var total_venta = 0;
                    var ig = parseFloat(document.getElementById('IGV').value) || 0.00; // Utiliza 0.00 como valor predeterminado si el campo está vacío o no es un número

                    // Obtener todas las filas de la tabla
                    var filas = document.querySelectorAll('#grilla tbody tr');

                    // Iterar sobre las filas y sumar los valores de la columna 4
                    filas.forEach(function(fila) {
                        var valorColumna = parseFloat(fila.cells[4].innerText.trim());
                        if (!isNaN(valorColumna)) {
                            total_venta += valorColumna;
                        }
                    });
                    igv = total_venta * (ig / 100); // Calcula el IGV
                    subtotal = total_venta - igv; // Calcula el subtotal
                    // Actualizar los valores en los campos de texto
                    document.getElementById('subtotal').value = subtotal.toFixed(2);
                    document.getElementById('igv_venta').value = igv.toFixed(2);
                    document.getElementById('total_venta').value = total_venta.toFixed(2);
                    console.log(total_venta);
                    var montoEnLetras = EnLetras(total_venta, "S/.");
                    console.log(montoEnLetras);
                    document.getElementById('total_ventaEnLetras').textContent = montoEnLetras;
                    document.getElementById('letrass').value = montoEnLetras;
                    mostrarletra();
                }
                function mostrarletra(){
                  var letra = document.getElementById('total_venta').value
                  if(letra>0){
                    document.getElementById("letras").style.display = "block";
                  }
                  else{
                    document.getElementById("letras").style.display = "none";
                  }
                };

                    // Llamar a la función calcularTotales cuando la página se carga y cada vez que se agrega o elimina un elemento de la grilla
                    window.addEventListener('load', calcularTotales);

                    
                    function agregarFilaGrilla(item) {
                      event.preventDefault(); 
                      var grillaBody = document.getElementById('grillaBody');
                      var newRow = grillaBody.insertRow();

                      // Crear celdas y asignarles el contenido del item
                      newRow.insertCell(0).textContent = item.orden;
                      newRow.insertCell(1).textContent = item.descripcion;
                      newRow.insertCell(2).textContent = 1;
                      newRow.insertCell(3).textContent = item.total;
                      newRow.insertCell(4).textContent = item.total;
                      // Crear celda para el botón eliminar
                      var cellEliminar = newRow.insertCell(5);
                      var btnEliminar = document.createElement("button");
                      btnEliminar.textContent = "ELIMINAR";
                      btnEliminar.className = "eliminar";
                      
                      btnEliminar.addEventListener("click", function() {
                        event.preventDefault(); 
                        eliminarFilaGrilla(this);
                        calcularTotales();
                      });
                      cellEliminar.appendChild(btnEliminar);
        
                    }
                      function eliminarFilaGrilla(btnEliminar) {
                        var rowIndex = btnEliminar.parentNode.parentNode.rowIndex;
                        document.getElementById("grilla").deleteRow(rowIndex);
                     }

                  // Evento de clic para el botón "btnAgregarItem"
                    document.getElementById('btnAgregarItem').addEventListener('click', function() {
                       if(document.getElementById('total').value > 0){
                            var formData = obtenerValoresFormulario();
                            var numeroFilas = document.getElementById('grilla').rows.length;
                            // Asignar el número de filas como el valor de norden
                            formData.orden = numeroFilas;
                            // Llamada a la función para agregar la fila a la grilla
                            agregarFilaGrilla(formData);
                            limpiaritem();
                            document.getElementById('item').focus();
                            calcularTotales();}
                      else{
                        alert('Revise El Item a Ingresar');
                        document.getElementById('item').focus();
                      }
                    });
                    function limpiaritem(){
                        document.getElementById('item').value='';
                    }
                    // Esta función debería obtener los valores del formulario y devolverlos como un objeto
                    function obtenerValoresFormulario() {
                        // Aquí obtienes los valores del formulario y los devuelves como un objeto
                        return {
                            orden: '',
                            cantidad: document.getElementById('cant').value,
                            descripcion: document.getElementById('item').value,
                            precioigv: document.getElementById('pigv').value,
                            total: document.getElementById('total').value
                        };
                    }
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
                        document.getElementById("interfazBusqueda1").style.display = "flex";
                        }
                        else if(a===2){
                        document.getElementById("interfazBusqueda2").style.display = "flex";
                        }
                        else if(a===3){
                        document.getElementById("interfazBusqueda3").style.display = "flex";
                        }
                        else if(a===4){
                        document.getElementById("interfazBusqueda4").style.display = "flex";
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
                    function showCustomMsgBox(message, title) {
                    document.getElementById('msgBoxTitle').innerText = title || 'Mensaje';
                    document.getElementById('msgBoxMessage').innerText = message;
                    document.getElementById('overlay').style.display = 'block';
                    document.getElementById('customMsgBox').style.display = 'block';
                    }

                    function closeCustomMsgBox() {
                        document.getElementById('overlay').style.display = 'none';
                        document.getElementById('customMsgBox').style.display = 'none';
                    }

                    function cerrarInterfaz() {
                        document.getElementById("interfazBusqueda1").style.display = "none";
                        document.getElementById("interfazBusqueda2").style.display = "none";      
                    }
                    window.addEventListener('message', function(event) {
                        var docu = document.getElementById('trans').value;
                        if (event.data.id !== undefined) {
                            var seleccion = (event.data.id || "").toString();
                            var idem = (event.data.idem || "").toString();
                            seleccion = seleccion.padStart(6, '0');
                            var idemp = seleccion + " " + idem;
                            console.log("Seleccionaste: " + idemp);
                              // Realizar la solicitud AJAX
                                  var xh = new XMLHttpRequest();
                                  xh.open("POST", "consultas/docu.php", true);
                                  xh.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                  xh.onreadystatechange = function() {
                                      if (xh.readyState === 4 && xh.status === 200) {
                                          var response = JSON.parse(xh.responseText);
                                            if (response.mensaje === "existe") {
                                              console.log(response.nota);
                                              if(response.nota === "no"){
                                                document.getElementById('NDOC').value = seleccion;
                                                $ndoc = seleccion;
                                                document.getElementById('nomb1').value = response.cliente ;
                                                document.getElementById('dire1').value = response.dir ;
                                                document.getElementById('rucDni1').value = response.txtruc ;
                                                document.getElementById('CONDI').value = response.condi ;
                                                document.getElementById('FECHAA').value = response.fecaten ;
                                                document.getElementById('transs').value = response.idemXY ;
                                                document.getElementById('cant').value = response.totbruto;
                                                document.getElementById('pigv').value = response.MonIGV;
                                                document.getElementById('total').value = response.totPrecVenta;
                                                const tabla = document.getElementById("grillaBody1");
                                                // Establece el contenido HTML de la tabla como una cadena vacía
                                                tabla.innerHTML = "";
                                                $table = response.table; 
                                                console.log($table);  
                                                for (let i = 0; i < $table.length; i++) {
                                                  var grillaBody = document.getElementById('grillaBody1');
                                                  var newRow = grillaBody.insertRow();
                                                  const item = response.table[i];
                                                  newRow.insertCell(0).textContent = item['NORD'];
                                                  newRow.insertCell(1).textContent = item['DESCFB'];
                                                  newRow.insertCell(2).textContent = formatNumber(item['CANT']);
                                                  newRow.insertCell(3).textContent = formatNumber(item['PREC']);
                                                  newRow.insertCell(4).textContent = formatNumber(item['VVTA']);
                                                }    
                                              }
                                              else{

                                                document.getElementById("overlay").style.display = "flex";
                                                document.getElementById("customMsgBox").style.display = "flex";
                                              }    
                                            }         
                                           else {
                                                  // Si el usuario no existe, solo da el foco
                                              alert('Error al Cargar Documento');
                                              window.location.href = 'boletas_facturas.php';
                                          }}
                                      
                                  };
                                  xh.send("docu=" + idemp);
                                  return false;
                        }
                    });

                    function formatNumber(number) {
                        return parseFloat(number).toFixed(2);
                    }
                    function total_compra() {
                      if (event.keyCode === 13) { // Comprobar si se presionó la tecla Enter
                                event.preventDefault(); // Evitar el envío del formulario
                                var total = document.getElementById('total').value;
                                document.getElementById('pNC').value = total;
                                document.getElementById('pNC').focus();
                                return false;
                            }
                    }
                    
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
                        // Eliminar caracteres no numéricos excepto el punto decimal
                        input.value = input.value.replace(/[^\d.]/g, '');

                        // Asegurarse de que solo haya un punto decimal
                        var puntos = input.value.match(/\./g);
                        if (puntos !== null && puntos.length > 1) {
                            input.value = input.value.substring(0, input.value.lastIndexOf('.'));
                        }
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

                    function dniruc(pro) {
                        if (event.keyCode === 13) {
                            event.preventDefault();
                            var dniruc;
                            if(pro===1){
                            dniru = document.getElementById("rucDni1").value;}
                            else if(pro===2){
                            dniru = document.getElementById("rucDni2").value;}
                            else if(pro===3){
                            dniru = document.getElementById("rucDni3").value;}
                            ApiRucDni(dniru)
                                .then(function(data) {
                                  if(pro===1){
                                    document.getElementById('nomb1').value = data.nomb || '';
                                    document.getElementById('dire1').value = data.dire || 'Arequipa';
                                    document.getElementById('rucDni2').focus();
                                    }
                                   else  if(pro===2){
                                    document.getElementById('nomb2').value = data.nomb || '';
                                    document.getElementById('dire2').value = data.dire || 'Arequipa';
                                    document.getElementById('rucDni3').focus();
                                    }
                                    else if(pro===3){
                                    document.getElementById('nomb3').value = data.nomb || '';
                                    document.getElementById('dire3').value = data.dire || 'Arequipa';
                                    document.getElementById('punto_llegada').value = document.getElementById('dire3').value 
                                    document.getElementById('datosDestino').focus();
                                    }
                                })
                                .catch(function(error) {
                                    console.error("Error: " + error);
                                    document.getElementById('rucDni2').focus();
                                });
                        }
                    }
                    
              </script>
            </body>
        </html>
        <?php
        mysqli_close($conexion);
    ?>
