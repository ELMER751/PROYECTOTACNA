<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ingresar_sesion.php");
    exit();}
?>
<?php
$codigo=$_GET["codigo"];
include_once('includes/acceso.php');
include_once('Clases/Camion.php');
$conexion = connect_db();
$camion = new Camion();
$camion->conectar_db($conexion);
$datos=$camion->busca($codigo);
?>
<!DOCTYPE html>
<html>
<head>
<title>Modifica Camion</title>
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
<input id="Codigo" type="text" name = "Codigo" value ="<?php echo $codigo;?>" placeholder="Código"> 
<!--<select class="input-box" name="Documento" id="Documento" placeholder="Documento">
            <option value="pdf">PDF</option>
            <option value="word">Word</option>
        </select>-->
</div>
<div class="input-box">
<p> Placa :</p>
<input id="Placa" type="text" name = "Placa" value ="<?php echo $datos['PLACA'];?>" placeholder= "Placa">    
</div>
<div class="input-box">
<p>Marca : </p>
<input id="Marca" type="text" name = "Marca" value ="<?php echo $datos['MARCA'];?>" placeholder= "Marca"> 

</div>
<div class="input-box">
    <p>Certificado :</p>
    <input id="Certificado" type="text" name = "Certificado" value ="<?php echo $datos['CERTIFICADO'];?>" placeholder= "Certificado">
</div>
<div class="input-box">
    <p>Config_ Vehicular :</p>
    <input id="CV" type="text" name = "CV" value ="<?php echo $datos['CONFIGURACION_VEHICULAR'];?>" placeholder= "Congif_ vehicular">
</div>
<div class="input-box">
    <p>Carga maxima :</p>
    <input id="Carga_m" type="text" name = "Carga_m" value ="<?php echo $datos['CARGA_MAXIMA'];?>" placeholder= "Carga Maxima">
</div>
<div class="input-box">
<button type="submit" name="modificar" class="btn"><img id="image" src="img/guardar.png" alt="Image 1" width="70px" height="70px"></button>
<button type="submit" name="buscaR" class="btn" disabled><img id="image" src="img/buscar.png" alt="Image 2" width="70px" height="70px"></button>
<button type="submit" name="elimina" class="btn"><img id="image" src="img/eliminarr.png" alt="Image 3" width="70px" height="70px"></button>
<button type="submit" name="x" class="btn"><img id="image" src="img/eliminar.png" alt="Image 4" width="70px" height="70px"></button>
<button type="submit" name="volver" class="btn" disabled><img id="image" src="img/salir.png" alt="Image 5" width="70px" height="70px"></button>
</div>
</form>
</div>
</body>
</html>
