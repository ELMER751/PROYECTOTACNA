<?php 
session_start();
if(!isset($_SESSION["username"])) {header("Location: ingresar_sesion.php");exit();}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MENU</title>
    <link rel="stylesheet" href="Css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </head>
  <style>
            header {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          background-color: #333; /* Color de fondo del header */
          color: #fff; /* Color del texto del header */
        }
        body {
          min-height: 100vh;
          background: url('Css/carro.png') no-repeat;
          background-size: cover;}
          
    </style>
    <body>
  <header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container-fluid justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Maestros
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="camiones.php">Camiones</a></li>
            <li><a class="dropdown-item" href="clientes_rapido.php">Clientes Rapido</a></li>
            <li><a class="dropdown-item" href="clientes.php">Clientes</a></li>
            <li><a class="dropdown-item" href="rutas.php">Rutas</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="empleados.php">Empleados</a></li>
            <li><a class="dropdown-item" href="t_de_pago.php">Tipo de Pago</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Operaciones
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="boletas_facturas.php">Boletas/Facturas</a></li>
            <li><a class="dropdown-item" href="doc_eliminados.php">Documentos eliminados</a></li>
            <li><a class="dropdown-item" href="n_de_credito.php">Notas de credito</a></li>
          </ul>
          </li>
          <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reportes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="liquidacion.php">Liquidacion</a></li>
            <li><a class="dropdown-item" href="r_de_ventas.php">Registro de Ventas</a></li>
          </ul>
          </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Salir</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="https://sosnetperu.com/index.html">Acerca</a>
        </li>
    </div>
  </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container-fluid justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li><a class="dropdown-item" href="boletas_facturas.php"><img src="img/image11.png" alt="Image 1" width="20px" height="20px"></a></li>
      <li><a class="dropdown-item" href="camiones.php"><img src="img/image2.png" alt="Image 2" width="20px" height="20px"></a></li>
      <li><a class="dropdown-item" href="clientes.php"><img src="img/cliente.jpg" alt="Image 3" width="20px" height="20px"></a></li>
      <li><a class="dropdown-item" href="calc.php"><img src="img/image4.png" alt="Image 4" width="20px" height="20px"></a></li>
      <li><a class="dropdown-item" href="users.php"><img src="img/usuarios..jpg" alt="Image 5" width="20px" height="20px"></a></li>
      <li><a class="dropdown-item" href="d_viaje.php"><img src="img/image6.png" alt="Image 6" width="20px" height="20px"></a></li>
      <div class="boton-modal">
        <label for="btn-modal">
        <a><img src="img/config.jpg" alt="Image 7" width="20px" height="20px"></a>
        </label>
      </div>
    
      </ul>
    </div>
  </div>
</nav>
</header>
<input type="checkbox" id="btn-modal" style ="display:none;">
<div class="container-modal">
        <div class="content-modal">
            <a>PARAMETROS</a>
            <iframe src="parametros_sistema.php" width="100%" height="100%" frameborder="1"></iframe>   
            <div class="btn-cerrar">
                <label for="btn-modal">Cerrar</label>
            </div>
        </div>
        <label for="btn-modal" class="cerrar-modal"></label>
    </div>
        </body>
</html>

