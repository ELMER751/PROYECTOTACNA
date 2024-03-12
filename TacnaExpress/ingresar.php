
<?php
session_start();
include_once('includes/acceso.php');
$conexion = connect_db();
$nombre = $_POST['Nombre_de_Usuario'];
$pass = $_POST['Contraseña'];
$query = mysqli_query($conexion, "SELECT * FROM fuser WHERE USUARIO = '$nombre'");
$nr = mysqli_num_rows($query);
$row = mysqli_fetch_array($query);


if ($nr == 1) {
    $passs = $row['PASSWORD'];
    $ass = $row['USUARIO'];
    if ($nombre === $ass) {
        if($pass === $passs){
            // Credenciales válidas, iniciar sesión
            $_SESSION['username'] = $row['USUARIO'];
            $_SESSION['user_id'] = $row['CODUSUARIO'];
            //echo "<script>alert('Se Modifico Con Éxito');window.location.href = 'espresstacna.php';</script>";
            header("Location: espresstacna.php");
            exit();
        }
        else{
            echo "<script>
            alert('Contraseña Incorrecta');
            window.history.back();
            </script>";
        }
    } 
    else{
        echo "<script>
            alert('El Nombre de Usuario es Incorrecto');
            window.history.back();
            </script>";
    }
} 

else if ($nr == 0) {

    // Usuario no encontrado
    echo "<script>
    alert('Nombre de Usuario No Encontrado');
    window.history.back();
    </script>";
}

$query->close();
$conexion->close();
?>


