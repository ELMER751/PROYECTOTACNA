<?php
    session_start();
    if (!isset($_SESSION["username"])) 
    {
        header("Location: ingresar_sesion.php");
        exit();
    }
?>
<?php
$codigo=$_GET["codigo"];
include_once('includes/acceso.php');
include_once('clases/registra_usua.php');
$conexion = connect_db();
$cliente = new Registro();
$cliente->conectar_db($conexion);
$datos=$cliente->consulta($codigo);
$user=$datos['USUARIO'];
$resultado = mysqli_query($conexion, "SELECT * FROM ruta ORDER BY CODIGO");
$documentos = mysqli_query($conexion, "SELECT * FROM usuario_documento WHERE CODUSUARIO ='$user'")
?>
<!DOCTYPE html>
<html>
<head>
<title>Registrar Empleado</title>
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
<style>
    .filled {
        flex: 1; /* Permite que los elementos de entrada y selección compartan el espacio disponible por igual */
        height: 50px;
        background: transparent;
        border-radius: 40px;
        font-size: 10px;
        background-color: #154360; /* Color de fondo para campos llenos */
    }
    #miSelect {
      width: 530px; /* Cambia este valor según tus necesidades */
    }
</style>

<form id="miFormulario" method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']);?>">
    <h1>Registrar Empleado</h1>
    <div class="input-box <?php echo !empty($datos['USUARIO']) ? 'filled' : ''; ?>">
        <input id="Nombre_d_Usuario" type="text" name="Nombre_d_Usuario" placeholder="Nombre de Usuario" maxlength="3" value="<?php echo $datos['USUARIO']?>" readonly>
    </div>
    <div class="input-box <?php echo !empty($datos['NOMBRES']) ? 'filled' : ''; ?>">
        <input id="Nombre" type="text" name="Nombre" placeholder="Nombre/Apellido" value="<?php echo $datos['NOMBRES']?>" oninput="this.value = this.value.toUpperCase()" required>
    </div>
    <div class="input-box <?php echo !empty($datos['PASSWORD']) ? 'filled' : ''; ?>">
        <input id="Contraseñaa" type="password" name="Contraseñaa" placeholder="Contraseña" value="<?php echo $datos['PASSWORD']?>" required>
    </div>
    <div style="display: flex;">
        <select name="Nivel"  style="flex: 1; margin-right: 10px; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px;">
            <option value="1" style="background-color: black; color: white;" <?php if ($datos['NIVEL'] == 1) echo 'selected' ; ?>>Administrador</option>
            <option value="0" style="background-color: black; color: white;" <?php if ($datos['NIVEL'] == 0) echo 'selected' ; ?>>Operador</option>
        </select>
        <select name="Sede" style="flex: 1; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px; margin-right: 10px;">
                <?php
                    // Iterar sobre los resultados de la consulta y generar opciones para el elemento de selección
                    if ($resultado) {
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='" . $fila['CODIGO'] . "' style='background-color: black; color: white;' " . ($fila['CODIGO'] == $datos['CEDE'] ? 'selected' : '') . ">" . $fila['DESTINO'] . "</option>";
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
    <div class="input-box <?php echo !empty($datos['OCUPACION']) ? 'filled' : ''; ?>">
        <input id="Ocupacion" type="text" name="Ocupacion" placeholder="Ocupación" value="<?php echo $datos['OCUPACION']?>" oninput="this.value = this.value.toUpperCase()" required>
    </div>
    <div class="input-box <?php echo !empty($datos['DNI']) ? 'filled' : ''; ?>">
        <input id="DNI" type="text" name="DNI" placeholder="DNI" value="<?php echo $datos['DNI']?>" maxlength = "8" required>
    </div>
    <div class="input-box <?php echo !empty($datos['BREVETE']) ? 'filled' : ''; ?>">
        <input id="Brevete" type="text" name="Brevete" placeholder="Brevete" value="<?php echo $datos['BREVETE']?>" required>
    </div>
    <div class="contenido">
            <label>Documentos</label>
            <div>
                <select id="miSelect"name="opciones[]" multiple>        
                    <?php
                        // Iterar sobre los resultados de la consulta y generar opciones para el elemento de selección
                        if ($documentos) {
                            while ($fila = mysqli_fetch_assoc($documentos)) {
                                echo "<option value='" . $fila['CODI'] . "'>" . $fila['CODI'] . "</option>";
                            }
                            // Liberar el resultado
                            mysqli_free_result($documentos);
                        } else {
                            // Si la consulta falla, mostrar un mensaje de error
                            echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
                        }
                    ?>
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
            <div id="interfazBusqueda" style="display: none;">
                <iframe src="busca_prueba.php?tabla=vftge2007&response=A&codi=EMPLE" width="600" height="400" frameborder="0"></iframe>
            </div>
        </div>
    <div>
        <input type="checkbox" name="miCheck" id="miCheck" <?php if ($datos['ACTI'] == 1) echo 'checked'; ?>>
        <label for="miCheck">Activo</label>
    </div>
    <div class="input-box">
        <button type="submit" name="modificar_empleado" class="btn"><img id="image" src="img/guardar.png" alt="Image 3" width="70px" height="70px"></button>
        <button type="submit" name="busqueda" class="btn" onclick="submitFormWithoutRequired()" disabled><img id="image" src="img/buscar.png" alt="Image 2" width="70px" height="70px"></button>
        <button type="submit" name="cancel" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/eliminar.png" alt="Image 2" width="70px" height="70px"></button>
        <button type="submit" name="volver" class="btn" onclick="submitFormWithoutRequired()"><img id="image" src="img/salir.png" alt="Image 3" width="70px" height="70px"></button>
    </div>
</form>
    <script>
        function mostrarInterfaz() {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        document.getElementById("interfazBusqueda").style.display = "block";
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