<?php
session_start();
if (!isset($_SESSION["username"])) {header("Location: ingresar_sesion.php");exit();}
?>
<?php
include_once('includes/acceso.php');
$conexion = connect_db();
$ultimo_codigo = mysqli_query($conexion, "SELECT MAX(CODIGO) AS ultimo_codigo FROM camiones");
$ultimo_codigo = mysqli_fetch_assoc($ultimo_codigo);
$ultimo_codigo = $ultimo_codigo["ultimo_codigo"];
mysqli_close($conexion);
?>
<!DOCTYPE html>
<html>
<head>
<title>Nuevo Camion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.win.css' rel='stylesheet'>
    <link rel="stylesheet" href="Css/loginnn.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/interfas.js" ></script>  
</head>
<body>
<div class="wrapper">
 <form method="POST" action="procesos.php">
 <h1> DATOS </h1>
<div class="input-box">
<p> Código :</p>
<input id="Codigo" type="text" name = "Codigo" value ="<?php echo $ultimo_codigo+1; ?>" placeholder="Código"> 
<!--<select class="input-box" name="Documento" id="Documento" placeholder="Documento">
            <option value="pdf">PDF</option>
            <option value="word">Word</option>
        </select>-->
</div>
<div class="input-box">
<p> Placa :</p>
<input id="Placa" type="text" name = "Placa" placeholder= "Placa" autofocus>    
</div>
<div class="input-box">
<p>Marca : </p>
<input id="Marca" type="text" name = "Marca" placeholder= "Marca"> 
        <!--<select class="input-box" name="Tipo_Venta" id="Tipo_Venta">
            <option value="factura">Factura</option>
            <option value="boleta">Boleta</option>
        </select>-->
</div>
<div class="input-box">
    <p>Certificado :</p>
    <input id="Certificado" type="text" name = "Certificado" placeholder= "Certificado">
</div>
<div class="input-box">
    <p>Config_ Vehicular :</p>
    <input id="CV" type="text" name = "CV" placeholder= "Congif_ vehicular">
</div>
<div class="input-box">
    <p>Carga maxima :</p>
    <input id="Carga_m" type="text" name = "Carga_m" placeholder= "Carga Maxima">
</div>
<div class="input-box">
<button type="submit" name="guardado" class="btn"><img id="image" src="img/guardar.png" alt="Image 1" width="70px" height="70px"></button>
<button type="submit" name="busca" class="btn" disabled><img id="image" src="img/buscar.png" alt="Image 2" width="70px" height="70px"></button>
<button type="submit" name="elimina" class="btn" disabled><img id="image" src="img/eliminarr.png" alt="Image 3" width="70px" height="70px"></button>
<button type="submit" name="x" class="btn"><img id="image" src="img/eliminar.png" alt="Image 4" width="70px" height="70px"></button>
<button type="submit" name="volver" class="btn" disabled><img id="image" src="img/salir.png" alt="Image 5" width="70px" height="70px"></button>
</div>
</form>
</div>
</body>
</html>