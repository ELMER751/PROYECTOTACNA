<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: ingresar_sesion.php");
        exit();
    }
    //include_once('header.php');
    include_once('includes/acceso.php');
    $conexion = connect_db();
    // Verificar la conexión
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
        exit();
    }
    // Realizar la consulta
    $resultado = mysqli_query($conexion, "SELECT * FROM ruta ORDER BY CODIGO");
    $user = $_SESSION["username"];
    $nivel = mysqli_query($conexion, "SELECT * FROM fuser WHERE USUARIO = '$user'");
    $nivel = mysqli_fetch_assoc($nivel);
    $nivel = $nivel['NIVEL']; 
    if ($nivel === "1")
    {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Css/loginnn.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    #miSelect {
      width: 530px; /* Cambia este valor según tus necesidades */
    }
</style>
<body>
<div class="wrapper">
    <form id="miFormulario" method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']);?>">
        <h1> Registrar Empleado </h1>
        <div class="input-box">
            <input id="Nombre_d_Usuario" type="text" name="Nombre_d_Usuario" placeholder="Nombre de Usuario" maxlength="3" required oninput="this.value = this.value.toUpperCase()" onkeypress="verificarUsuario(event)">
    <script>
        function verificarUsuario(event) {
    // Verificar si se presionó la tecla Enter (código ASCII 13)
            if (event.keyCode === 13) {
                event.preventDefault(); // Evitar el envío del formulario
                var nombreUsuario = document.getElementById("Nombre_d_Usuario").value;

                // Realizar la solicitud AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "verifica.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var respuesta = xhr.responseText;
                        if (respuesta === "El nombre de usuario ya existe en la tabla") {
                            // Si el usuario existe, borra el campo y da el foco
                            alert(respuesta); // Mostrar respuesta en una alerta (solo para depuración)
                            document.getElementById("Nombre_d_Usuario").value = "";
                            document.getElementById("Nombre_d_Usuario").focus();
                        } else {
                            // Si el usuario no existe, solo da el foco
                            document.getElementById("Nombre").focus();
                        }
                    }
                };
                xhr.send("Nombre_d_Usuario=" + nombreUsuario);
                return false; // Evitar la propagación del evento
            }
        }
    </script>
        </div>
        <div class="input-box">
            <input id="Nombre" type="text" name="Nombre" placeholder=" Nombre/Apellido" required oninput="this.value = this.value.toUpperCase()">
        </div>
        <div class="input-box">
            <input id="Contraseñaa" type="password" name="Contraseñaa" placeholder="Contraseña" required>
        </div>
        <div style="display: flex;">
            <select name="Nivel" style="flex: 1; height: 100%; background: white; border: none; outline: none; border-radius: 40px; font-size: 16px; color: black; padding: 10px 45px 10px 10px; margin-right: 10px;">
                <option value="1" style="background-color: black; color: white; ">Administrador</option>
                <option value="0" style="background-color: black; color: white; ">Operador</option>  
            </select>
            <select name="Sede" style="flex: 1; height: 100%; background: white; border: none; outline: none; border-radius: 40px; font-size: 16px; color: black; padding: 10px 45px 10px 10px; margin-right: 10px;">
                <?php
                    // Iterar sobre los resultados de la consulta y generar opciones para el elemento de selección
                    if ($resultado) {
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='" . $fila['CODIGO'] . "' style='background-color: black; color: white;'>" . $fila['DESTINO'] . "</option>";
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
            <input id="Ocupacion" type="text" name="Ocupacion" placeholder="Ocupación" required oninput="this.value = this.value.toUpperCase()">
        </div>
        <div class="input-box">
            <input id="DNI" type="text" name="DNI" placeholder="DNI" required>
        </div>
        <div class="input-box">
            <input id="Brevete" type="text" name="Brevete" placeholder="Brevete">
        </div >
        <div class="contenido">
            <label>Documentos</label>
            <div>
                <select id="miSelect"name="opciones[]" multiple style=" display: none;">        
                </select>
            </div>
            <br>
            <div>
            <input onclick="submitFormWithoutRequired()" type="submit" value="Enviar" name="enviar">
            <input type="text" id="nuevaOpcion" name="nuevaOpcion" readonly>
            <button type="button" onclick="mostrarInterfaz()">Buscar</button>
            <button type="button" onclick="agregarOpcion()">Agregar</button>
            <button type="button" onclick="eliminarOpcion()">Eliminar</button>
            </div>
            <div id="interfazBusqueda" style="width: 100%; height: 100vh; position: fixed; top: 0; left: 0; background-color: rgba(144, 148, 150, 0.8); display: none; justify-content: center; align-items: center; z-index: 100;">
                <iframe src="busca_prueba.php?tabla=vftge2007&response=A&codi=EMPLE" width="600" height="400" frameborder="0"></iframe>
            </div>
        </div>
        <div>
            <input type="checkbox" name="miCheck" id="miCheck">
            <label for="miCheck">Activo</label>
        </div>
        <div class="input-box">
            <button type="submit" name="registra" class="btn"><img id="image" src="img/guardar.png" alt="Image 3" width="70px" height="70px"></button>
            <button type="submit" name="busqueda" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/buscar.png" alt="Image 2" width="70px" height="70px"></button>
            <button type="submit" name="refrescar" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/eliminar.png" alt="Image 2" width="70px" height="70px"></button>
            <button type="submit" name="volver" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/salir.png" alt="Image 3" width="70px" height="70px"></button>
        </div>
    </form>
    <script>
    function mostrarInterfaz() {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        document.getElementById("interfazBusqueda").style.display = "flex";
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
        function mostrar_select(){
            var selectElement = document.getElementById("miSelect");
            if (selectElement.options.length > 0){
                document.getElementById("miSelect").style.display = "block";
            }
            else{
                document.getElementById("miSelect").style.display = "none";
            }
            }

        function cerrarInterfaz() {
          document.getElementById('interfazBusqueda').style.display = 'none';
      }
        window.addEventListener('message', function(event) {
              document.getElementById('nuevaOpcion').value = event.data.docu ?? "";
              
          });

        function agregarOpcion() {
            var nuevaOpcion = document.getElementById('nuevaOpcion').value;
            if(nuevaOpcion!=""){
            var select = document.getElementById('miSelect');
            var option = document.createElement("option");
            option.text = nuevaOpcion;
            option.value = nuevaOpcion;
            select.add(option);
            console.log(option);
            mostrar_select();
            document.getElementById('nuevaOpcion').value="";
            }
      }

        function eliminarOpcion() {
          var select = document.getElementById('miSelect');
          for (var i = select.options.length - 1; i >= 0; i--) {
              if (select.options[i].selected) {
                  select.remove(i);
              }
              mostrar_select();
          }
      }
        document.getElementById('miFormulario').addEventListener('submit', function() {
          var select = document.getElementById('miSelect');
          for (var i = 0; i < select.options.length; i++) {
              select.options[i].selected = true;
          }
      });

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
<?php
    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
    }
    else{
        echo "<script>
        alert('Usted No Tiene Acceso Para Ingresar Aquí, Comuniquese con un Administrador');
        window.history.back();
        </script>";
        mysqli_close($conexion);
    }
?>