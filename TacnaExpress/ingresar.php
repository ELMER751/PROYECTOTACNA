
<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "tacnaexpressbd";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

$nombre = $_POST['Nombre_de_Usuario'];
$pass = $_POST['Contraseña'];
$query = mysqli_query($conn, "SELECT * FROM fuser WHERE USUARIO = '".$nombre."' AND PASSWORD = '".$pass."'");
$nr = mysqli_num_rows($query);
$row = mysqli_fetch_array($query);


if ($nr == 1) {
    $passs = $row['PASSWORD'];
    $ass = $row['USUARIO'];
    if (($pass == $passs)) {
        // Credenciales válidas, iniciar sesión
        $_SESSION['username'] = $row['USUARIO'];
        $_SESSION['user_id'] = $row['CODUSUARIO'];
        header("Location: espresstacna.php");
        exit();
    } 
} 


else if ($nr == 0) {

    // Usuario no encontrado
    echo "Usuario o contraseña incorrectos. <a href='ingresar_sesion.php'>Volver a intentar</a>";  
}


$query->close();
$conn->close();
?>


