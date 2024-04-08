<?php
//(session_start();
//if (!isset($_SESSION["username"])) {header("Location: ingresar_sesion.php");exit();}
?>
<?php
include_once('header.php');
include_once('includes/acceso.php');

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
        <h4>DOCUMENTOS ELIMINADOS</h4>
    </div>

    <div class="card card-body">
<table class="table table-bordered">
<thead>
                <tr>
                    <th>ITEMS</th>
                    <th>NDOC</th>
                    <th>USUARIO</th>
                    <th>FECHA</th>
                    <th>HORA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row=mysqli_fetch_array($datos_doc)){
                        $nom=$row['vendedor'];
                        $und=$row['documento'];
                        $can=$row['nro_venta'];
                        $pre=$row['cliente'];
                        $cos=$row['tipo_venta'];
                        $sas=$row['fecha'];
                        ?>
                        <tr>
                            <td><?php echo $nom; ?></td>
                            <td><?php echo $und; ?></td>
                            <td><?php echo $can; ?></td>
                            <td><?php echo $pre; ?></td>
                            <td><?php echo $cos; ?></td>
                            <td><?php echo $sas; ?></td>
                            <td><a href="elimina_doc.php?codigo=<?php echo $id; ?>" class="btn btn-info">Eliminar</a></td>
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