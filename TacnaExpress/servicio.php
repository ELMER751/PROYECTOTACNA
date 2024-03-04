<?php  //echo "<h1> SERVICIO WEB 1 - LISTA DE PRODUCTOS </h1>";
$usuario="root"; 
$contraseña="";
try {
    $stmt = new PDO('mysql:host=localhost;dbname=tacnaexpressbd', $usuario, $contraseña);
    $stmt = $stmt->prepare("SELECT * FROM `fuser`");
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //echo json_encode($productos); // Generamos el JSON de Productos
    header('Context-type: text/xml');
    echo '<?xml version="1.0">';
    echo '';
    foreach($productos as $index => $post){
        echo '<fuser>';
        if(is_array($post)){
            foreach($post as $key => $value ){
                echo '<'.$key.'>';
                if(is_array($value)){
                    foreach($value as $tag => $val){
                        echo '<'.$tag.'>',htmlentities($val).'';
                        echo $val;
                    }
                }
                else{
                    echo $value;
                }
                echo '</'.$key.'>';
            }
        }
        echo '</fuser>';
    }
    echo '</xml>';
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}?>
