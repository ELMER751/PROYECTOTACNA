<?php
//echo "<h1> SERVICIO WEB 1 - LISTA DE PRODUCTOS </h1>";
$usuario = "root";
$contraseña = "";
try {
    $stmt = new PDO('mysql:host=localhost;dbname=tacnaexpressbd', $usuario, $contraseña);
    $stmt = $stmt->prepare("SELECT * FROM `camiones`");
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Agregado FETCH_ASSOC para obtener un array asociativo

    // Generamos el JSON de Productos
    echo json_encode($productos);
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>