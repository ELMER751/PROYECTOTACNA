<?php 
    include_once('header.php');
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Registro de Ventas</title>
    <html lang="es">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/boleta1.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    
        <body>
                <div class="wrapper">
                  <form class ="formulario" id="miFormulario" method="POST" action="procesos.php?pagina_anterior=<?php echo urlencode($_SERVER['PHP_SELF']); ?>">
                    <h1>Generación de Documentos</h1>
                        <div class="contenido">
                            <div class="contenido">
                                <label>De :</label>
                                <input type="date" name="fechai" id="fechai" style="width: 12ch;" value="<?php echo date('Y-m-01');?>">
                                <label>Al :</label>
                                <input type="date" name="fechaf" id="fechaf" style="width: 12ch;" value="<?php echo date('Y-m-d');?>">
                                <input type="checkbox" name = "dale" value ="control">
                                <a>Imprime Lista de Control</a>
                            </div>
                            <div class="contenido" style="text-align: left;">
                            <input style="" type="radio" name="dale1" id="control1">
                            <label for="control1">Buscar Por Razón Social</label>
                            <br>
                            <input style="" type="radio" name="dale1" id="control2">
                            <label for="control2">Buscar Por Nombre</label>
                            <br>
                            <select style="width: 50ch;" name="datosDestino" id="datosDestino">
                                    <option value="">SELECCIONE</option>
                                        
                                    </select>
                            </div>
                        <div class="contenido"> 
                            <div class="contenido" style="display: inline-block; width: 200px;">
                                <label>Condición</label>
                                <br>
                                <input type="checkbox" name="Contado" id="Contado" value="Contado">
                                <label for="Contado">Contado</label>
                                <br>
                                <input type="checkbox" name="Credito" id="Credito" value="Credito">
                                <label for="Credito">Crédito</label>
                                <br>
                                <input type="checkbox" name="PagoB" id="PagoB" value="PagoB">
                                <label for="PagoB">Pago débito</label>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="contenido" style="display: inline-block; width: 200px;">
                                <label>Documento</label>
                                <br>
                                <input type="checkbox" name="Factura" id= "Factura" value="Factura">
                                <label for="Factura">Factura</label>
                                <br>
                                <input type="checkbox" name="Boleta" id="Boleta" value="Boleta">
                                <label for="Boleta">Boleta</label>
                                <br>
                                <br>
                            </div>
                        </div>  
                        <div class = "contenido" style="display: inline-block">
                                <button type="submit" name="imprimir" class="btn" id="image1" ><img src="img/imprime.png" alt="image 1" width="30px" height="30px"></button>
                                <button type="submit" name="refrescar" class="btn" onclick="submitFormWithoutRequired()"><img id="image2" src="img/eliminar.png" alt="image 2" width="30px" height="30px"></button>
                                <button type="submit" name="volver" class="btn" onclick="submitFormWithoutRequired()"><img id="image3" src="img/salir.png" alt="Image 4" width="30px" height="30px"></button>
                        </div>                       
                      </div>
                      
                    </form>
                  </div>
                </div>
            </div>
        </body>
   
</html>
                
                    