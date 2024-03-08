<!DOCTYPE html>
<html>
<head>
<title>Venta</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.win.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/loginnn.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="wrapper">
 <form method="POST" action="re_venta.php">
 <h1> Registro de Venta </h1>
 <?php 

 ?>
<div class="input-box">
<input id="Usuario" type="text" name = "Usuario" placeholder=" Vendedor " required> 
<select class="input-box" name="Documento" id="Documento" placeholder="Documento">
            <option value="pdf">PDF</option>
            <option value="word">Word</option>
        </select>
<input id="Nro" type="text" name = "Nro" placeholder= "Numero de Venta" required>    
</div>

<div class="input-box">
<input id="Cliente" type="text" name = "Cliente" placeholder= "Cliente" required> 
        <select class="input-box" name="Tipo_Venta" id="Tipo_Venta">
            <option value="factura">Factura</option>
            <option value="boleta">Boleta</option>
        </select>
<input id="Fecha" type="text" name = "Fecha" placeholder= "Fecha" required>
</div>
<button type="submit" value="registra"class="btn">Registrar Venta</button>
</form>

</body>
</html>