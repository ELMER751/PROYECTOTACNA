<?php
    session_start();
    if (!isset($_SESSION["username"])) 
    {
        header("Location: ingresar_sesion.php");
        exit();
    }
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
<body>
<div class="wrapper">
    <form method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']);?>">
        <h1> Registrar Empleado </h1>
        <div class="input-box">
            <input id="Nombre_d_Usuario" type="text" name = "Nombre_d_Usuario" placeholder=" Nombre de Usuario " maxlength = "3" required oninput="this.value = this.value.toUpperCase()">
        </div>
        <div class="input-box">
            <input id="Nombre" type="text" name = "Nombre" placeholder=" Nombre/Apellido" required oninput="this.value = this.value.toUpperCase()">
        </div>
        <div class="input-box">
            <input id="Contraseñaa" type="password" name = "Contraseñaa" placeholder= "Contraseña" required>
        </div>
        <div style="display: flex;">
            <select name="Nivel" style="flex: 1; margin-right: 10px; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px;">
                <option value="1" style="background-color: black; color: white; ">Administrador</option>
                <option value="0" style="background-color: black; color: white; ">Operador</option>  
            </select>
            <select name="Sede" style="flex: 1; height: 100%; background: transparent; border: none; outline: none; border: 2px solid rgba(255,255,255, .2); border-radius: 40px; font-size: 16px; color: white; padding: 10px 45px 10px 10px; margin-right: 10px;">
                <option value="01" style="background-color: black; color: white; ">Arequipa</option>
                <option value="02" style="background-color: black; color: white; ">Tacna</option>
                <option value="03" style="background-color: black; color: white; ">Ilo</option>
                <option value="04" style="background-color: black; color: white; ">Moquegua</option>  
                <option value="05" style="background-color: black; color: white; ">Juliaca</option>
                <option value="06" style="background-color: black; color: white; ">Puno</option>    
                <option value="07" style="background-color: black; color: white; ">Cusco</option>  
            </select>
        </div>
        <div class="input-box">
            <input id="Ocupacion" type="text" name = "Ocupacion" placeholder= "Ocupación" required>
        </div>
        <div class="input-box">
            <input id="DNI" type="text" name = "DNI" placeholder= "DNI" required>
        </div>
        <div class="input-box">
            <input id="Brevete" type="text" name = "Brevete" placeholder= "Brevete" required>
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