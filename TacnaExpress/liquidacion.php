<?php
//session_start();
//if (!isset($_SESSION["username"])) {header("Location: ingresar_sesion.php");exit();}
?>
<?php
    include_once('header.php');
    include_once('includes/acceso.php');
    $conexion = connect_db();
    $fec_trans = date('Y-m-d');
    $user = $_SESSION["username"];
    $cede = mysqli_query($conexion, "SELECT * FROM fuser WHERE USUARIO = '$user'");
    $cede = mysqli_fetch_assoc($cede);
    $cede = $cede['CEDE'];
    $liqui = mysqli_query($conexion, "SELECT * FROM DATOS_FIJOS WHERE FEC_TRANS = '$fec_trans' AND CEDE = '$cede'");
    $liqui = mysqli_fetch_assoc($liqui);
    $liquidacion = $liqui['LIQUIDACION'] ?? '';
    $busca = mysqli_query($conexion, "SELECT * FROM datos_fijos WHERE LIQUIDACION = '$liquidacion'");
    $busca = mysqli_fetch_assoc($busca);
     
    if (isset($busca['LIQUIDACION'])) {
        
    }
?>
<!DOCTYPE html>
    <html lang="es">

    <head>
    <link rel="stylesheet" href="css/boleta1.css">
    <style>
    </style>    
    </head>
    <body>
         <div class ="wrapper">
            <form class ="formulario" id="miFormulario" method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']); ?>">
                            
            <div class="contenido">
                <h1>Liquidación</h1>
                                    <div class="contenido">
                                    <button type="submit" name="imprimir" class="btn" id="image1" ><img src="img/imprime.png" alt="image 1" width="30px" height="30px"></button>
                                        <button type="submit" name="volver" class="btn" onclick="submitFormWithoutRequired()"><img id="image3" src="img/salir.png" alt="Image 4" width="30px" height="30px"></button>
                                        <label>Fecha :</label>
                                        <input type="date" name="fecha" id="fecha" style="width: 12ch;" value="<?php echo date('Y-m-d');?>">
                                        <label>Destino :</label>
                                        <select style="width: 15ch;" name="datosDestino" id="datosDestino">
                                            <option value="">SELECCIONE</option> 
                                        </select>
                                        <input type="checkbox" name = "dale" value ="control">
                                        <label>Imprime Reporte de Cuenta Corriente</label>
                                    </div>
                                    <div class="contenido">
                                        <h5><?php echo "LIQUIDACIÓN - $liquidacion"?></h5>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div style="display: inline-block; text-align: right;">
                                            <label for="control1">Camión</label>
                                            <select style="width: 15ch;" name="datosDestino" id="datosDestino">
                                                <option value="">SELECCIONE</option> 
                                            </select>
                                            <br>
                                            <label for="control2">Chofer</label>
                                            <select style="width: 15ch;" name="datosDestino" id="datosDestino">
                                                <option value="">SELECCIONE</option> 
                                            </select>
                                        </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    
                                    
                                        <div style="display: inline-block;text-align: right;">
                                            <label for="control1">Liquidador</label>
                                            <select style="width: 15ch;" name="datosDestino" id="datosDestino">
                                                <option value="">SELECCIONE</option> 
                                            </select>
                                            <br>
                                            <label for="control1">Copiloto</label>
                                            <select style="width: 15ch;" name="datosDestino" id="datosDestino">
                                                <option value="">SELECCIONE</option> 
                                            </select>
                                        </div>
                                    </div>                     
                            </div>
                        </form>
                </div>
    
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selects = document.querySelectorAll(".contenido select");
            selects.forEach(function(select) {
                select.disabled = true;
            });
        });
    </script>
</html>