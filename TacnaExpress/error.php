<?php
session_start();
if (!isset($_SESSION["username"])) {header("Location: ingresar_sesion.php");exit();}
?>
<?php
?>
<!DOCTYPE html>
<html>
<head>
<title>DC</title>
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
<form method="POST" action="re_camiones.php">
<h1>Hubo un error registrando los datos, vuelva a intentarlo</h1>
<div class="input-box">
<button type="submit" name="xd" class="btn"><img id="image" src="img/dnuevo.png" alt="Image 4" width="70px" height="70px"></button>
</div>
</form>
</div>
</body>
</html>