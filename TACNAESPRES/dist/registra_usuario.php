<!DOCTYPE html>
<html>
<head>
<title>Iniciar Sesión</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.win.css' rel='stylesheet'>
    <link rel="stylesheet" href="Css/loginn.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="wrapper">
 <form method="POST" action="registra.php">
 <h1> Registrar </h1>

<div class="input-box">
<input id="Nombre_d_Usuario" type="text" name = "Nombre_d_Usuario" placeholder=" Nombre de Usuario " maxlength = "3" required>
</div>
<div class="input-box">
<input id="Contraseñaa" type="password" name = "Contraseñaa" placeholder= "Contraseña" required>
</div>
<button type="submit" value="registra"class="btn">Registrar</button>
<div class="register-link">
<p>¿Ya tienes una cuenta? <a href="ingresar_sesion.php">Iniciar sesión</a></p>
</div>
</form>
</body>
</html>