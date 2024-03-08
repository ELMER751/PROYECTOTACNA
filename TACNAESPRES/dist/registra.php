<?php
if (isset($_POST['registra'])){
    $act = isset($_POST["miCheck"]) && $_POST["miCheck"] === "on" ? 1 : 0;
    $nivel = isset($_POST["Nivel"]) && $_POST["Nivel"] === "1" ? 1 : 0;
    $cede = $_POST['Sede'];
    echo "El valor del checkbox es: " . $act . "<br>";
    echo "El valor del select es: " . $nivel;
    $nom= $_POST['Nombre'];
    $user = $_POST['Nombre_d_Usuario'];
    $pas = $_POST['Contraseñaa'];
    $dni=$_POST['DNI'];
    $bre = $_POST['Brevete'];
    $ocu = $_POST['Ocupacion'] ?? '';
    include_once('includes/acceso.php');
    include_once('clases/registra_usua.php');
    $conexion = connect_db();
    $oproduct = new Registro();
    $oproduct->conectar_db($conexion);
    
    $response = $oproduct->registrar_usuario($user,$pas,$nom,$nivel,$act,$ocu,$dni,$bre,$cede);

    if($response) {
        echo"
        <script>
            alert('Se Registro Nuevo Usuario Con Exito');
            window.location.href = 'espresstacna.php';
        </script>
        ";
    } else {
    echo"
        <script>
            alert('Hubo Un Error Inesperado Vuelve A Intentar');
            window.location.href = 'empleados.php';
        </script>
        ";
    }
    
}
?>