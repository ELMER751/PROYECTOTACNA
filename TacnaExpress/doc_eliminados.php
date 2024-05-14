<?php
//(session_start();
//if (!isset($_SESSION["username"])) {header("Location: ingresar_sesion.php");exit();}
?>
<?php
include_once('header.php');
include_once('includes/acceso.php');
$conexion = connect_db();
$datos_doc = mysqli_query($conexion, "SELECT * from  FDOCELIMINADOS ORDER BY FECHA");


?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIQUIDACION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
  margin: 6px;
  padding-top: 100px;
}
</style>
<body>
<div class="container p-12">
        <div class="row">
        <div class="container p-4">
        
    </div>

    <div class="card card-body">
    <h4>DOCUMENTOS ELIMINADOS</h4>
    <br>
<table class="table table-bordered">
<thead>
                <tr>
                    <th>NDOC</th>
                    <th>IDEM</th>
                    <th>USUARIO</th>
                    <th>FECHA</th>
                    <th>HORA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row=mysqli_fetch_array($datos_doc)){
                        $ndoc=$row['NDOC'];
                        $idem=$row['IDEM'];
                        $usr=$row['USUARIO'];
                        $fecha=$row['FECHA'];
                        $hora=$row['HORA'];
                        ?>
                        <tr>
                            <td><?php echo $ndoc; ?></td>
                            <td><?php echo $idem; ?></td>
                            <td><?php echo $usr; ?></td>
                            <td><?php echo $fecha; ?></td>
                            <td><?php echo $hora; ?></td>
                        </tr>
                <?php
                    }
                ?>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>       
</body>
</html>