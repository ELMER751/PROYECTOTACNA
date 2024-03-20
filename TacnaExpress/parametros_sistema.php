<?php 
    include_once('includes/acceso.php');
    $conexion = connect_db();
    $documentos = mysqli_query($conexion,"SELECT * FROM vftge2007");
    $parametros = mysqli_query($conexion,"SELECT * FROM ftge2007 WHERE CODI = '14' ");
    $parametros = mysqli_fetch_assoc($parametros); 
?>

<!DOCTYPE html>
            <html lang="es">
            <head>
            <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
                <link rel="stylesheet" href="Css/parametros.css">
                <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
                <script src="js/funciones.js"></script>
                <meta charset="UTF-8">
                <title>Generación de Documentos</title>
            </head>
            <style>
              input[readonly] {
            background-color: lightgray; /* Cambia el fondo a gris claro */
            }
            </style>
            <body>
              <div class="wrapper">
                <form class ="formulario" id="miFormulario" method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']); ?>">
                    <div class="contenido">
                        <a>Datos generales:</a>
                      <div class="contenido">
                        <div>
                            <label>Documento :</label>
                            <select name="docu" id ="miSelector" onchange = "change_documento()">
                                <option value=""></option>
                                <?php
                                if ($documentos) {
                                    while ($fila = mysqli_fetch_assoc($documentos)) {
                                          echo "<option value='" . $fila['CODI'] . "' style='background-color: black; color: white;'>" . $fila['DOCUMENTO'] .  "</option>";
                                    }
                                      mysqli_free_result($documentos);
                                } else {
                                     echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
                                }
                                ?>  
                            </select>
                            
                            <a>N° a Generar :</a>
                            <input id="NR" type="text" oninput="validarCodigo(this)" name="NR" required style="width: 12ch;" onkeypress="return handleEnter(event, 'enviar')">
                            <input onclick="submitFormWithoutRequired()" type="submit" value="Enviar" name="enviar" id="enviar">
                        </div>
                        <div class="contenido">
                            <a>Empresa</a>
                            <div>
                                <label>Nombre : </label>
                                <input id="nomb" type="text" name="nomb"  value ="<?php echo $parametros['NOMB'] ?? '';?>" oninput="validarIGV(this)" required style="width: 40ch;" max="100" onkeypress="return handleEnter(event, 'rucDni1')">
                                <br>
                                <label>Dirección : </label>
                                <input id="dire" type="text" name="dire"  value ="<?php echo $parametros['DIRE'] ?? '';?>" oninput="validarIGV(this)" required style="width: 40ch;" max="100" onkeypress="return handleEnter(event, 'rucDni1')">
                                <br>
                                <label>Ciudad : </label>
                                <select name="ciudad" id ="ciudad" style="width: 39.5ch;">
                                    <option value="<?php echo $parametros['CITY'] ?? '';?>"><?php echo $parametros['CITY'] ?? '';?></option>
                                   
                                    
                                    
                                </select>
                                <br>
                                <label>País : </label>
                                <select name="pais" id ="pais" onchange = "cargarDepartamentos()" style="width: 39.5ch;">
                                    <option value="<?php echo $parametros['CITY'] ?? '';?>"><?php echo $parametros['PAIS'] ?? '';?></option>
                                    
                                </select>
                                <br>
                                <label>Api Rest : </label>
                                <input type="checkbox" name="miCheck" id="miCheck" <?php if ($parametros['COMC1'] == 1) echo 'checked'; ?>>                            
                            </div>
                            <div class="input-box">
                                <button type="submit" name="guardar_parametros" class="btn" onclick="RD()"><img id="image" src="img/aceptar.png" alt="Image 1" width="70px" height="70px"></button>
                                <button type="submit" name="volver" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/eliminar.png" alt="Image 3" width="70px" height="70px"></button>
                            </div>    
                        </div>        
                        </div>
                    </div>
                  </form>
              </div>                                   
              <script>
                function cargarPaises() {
                    fetch('https://restcountries.com/v3.1/all')
                        .then(response => response.json())
                        .then(data => {
                            const selectPais = document.getElementById("pais");
                            
                            // Obtener los nombres de los países y ordenarlos alfabéticamente
                            const paises = data.map(pais => pais.name.common).sort();
                            
                            // Iterar sobre los países ordenados y agregarlos como opciones al select
                            paises.forEach(pais => {
                                const option = document.createElement("option");
                                option.value = pais;
                                option.textContent = pais;
                                selectPais.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error al obtener los países:', error));
                }

                function cargarDepartamentos() {
                    const selectPais = document.getElementById("pais");
                    const selectDepartamento = document.getElementById("ciudad");
                    const paisSeleccionado = selectPais.value;
                    selectDepartamento.innerHTML = ""; // Limpiar las opciones existentes

                    // Realizar la solicitud para obtener los estados o departamentos del país seleccionado
                    fetch(`https://countriesnow.space/api/v0.1/countries/states`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            country: paisSeleccionado
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Obtener los nombres de los departamentos y ordenarlos alfabéticamente
                        const departamentos = data.data.states.map(departamento => departamento.name).sort();
                        
                        // Iterar sobre los departamentos ordenados y agregarlos como opciones al select
                        departamentos.forEach(departamento => {
                            const option = document.createElement("option");
                            option.value = departamento;
                            option.textContent = departamento;
                            selectDepartamento.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error al obtener los departamentos:', error));
                }
                window.onload = function() {
                    cargarPaises();
                };

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
                                document.getElementById("hor").value = "<?php date_default_timezone_set('America/Lima'); echo date('H:i:s');?>";
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
                
                
                    function limpiaritem(){
                        document.getElementById('cant').value='';
                        document.getElementById('item').value='';
                        document.getElementById('pigv').value='';
                        document.getElementById('total').value='';
                    }
                    // Esta función debería obtener los valores del formulario y devolverlos como un objeto
                    
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
                    function change_documento() {
                        var seleccion = document.getElementById("miSelector").value;
                        // Hacer algo con la selección, por ejemplo, mostrarla en la consola
                        console.log("Seleccionaste: " + seleccion);
                    // Realizar la solicitud AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "consultas/documento.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                var response = JSON.parse(xhr.responseText);
                                if (response.mensaje === "existe") {
                                    document.getElementById('NR').value = response.nr;            
                                } else {
                                        // Si el usuario no existe, solo da el foco
                                    document.getElementById('NR').value = "";
                                 }
                            }
                        };
                        xhr.send("miSelector=" + seleccion);
                        return false;
                    }
                    
              </script>
            </body>
        </html>