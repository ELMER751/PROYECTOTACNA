<?php
session_start();
if (!isset($_SESSION["username"])) {header("Location: ingresar_sesion.php");exit();}
?>
<?php
?>
<!DOCTYPE html>
<html>
<head>
<title>Menu de camiones</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/loginnn.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="wrapper">
 <form method="POST" action="procesos.php">
<h1>MENÚ DE OPCIONES</h1>
<div class="input-box">
<button type="submit" name="guardar" class="btn"><img id="image" src="img/guardar.png" alt="Image 1" width="70px" height="70px"></button>
<button type="submit" name="buscar" class="btn"><img id="image" src="img/buscar.png" alt="Image 2" width="70px" height="70px"></button>
<button type="submit" name="elimina" class="btn" disabled><img id="image" src="img/eliminarr.png" alt="Image 3" width="70px" height="70px"></button>
<button type="submit" name="x" class="btn" disabled><img id="image" src="img/eliminar.png" alt="Image 4" width="70px" height="70px"></button>
<button type="submit" name="volver" class="btn"><img id="image" src="img/salir.png" alt="Image 5" width="70px" height="70px"></button>
<!--<button type="submit" name="js" class="btn"><img id="image" src="img/js.png" alt="Image 6" width="70px" height="70px"></button>-->
</div>
</form>
</div>
</body>
</html>
