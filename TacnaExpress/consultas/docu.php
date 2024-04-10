<?php
include_once("../includes/acceso.php");
$conexion = connect_db();
// Realizar una consulta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre de usuario enviado por AJAX
    $ndoc = $_POST["docu"];
    // Consultar si el nombre de usuario ya existe en la tabla fuser
    $sql = "SELECT * FROM fcabecer WHERE DOC1 = '$ndoc'";
    $result = $conexion->query($sql);
    $result = mysqli_fetch_assoc($result);

    // Verificar si se encontraron resultados
    if (isset($result['DOC1'])) {
        $idemXY = $result['IDEM'];
        $Numdoc = $result['DOC1'];
        $table = mysqli_query($conexion,"SELECT * FROM vfarmamovifd WHERE DOC1 = '$ndoc' AND IDEM = '$idemXY'");
        $table=mysqli_fetch_array($table);
        $table = array($table);
        $txtruc = $result['CODI']; 
        $totbruto = $result['MONB'];
        $vvtatot = $result['MONB'];
        $MonIGV = $result['IGVE'] ;
        $totPrecVenta = $result['TOTL'];
        $Date = $result['FEC1'];
        $fecaten = $result['FEC2'];
        $cliente = $result['NOMEMPRE'];
        $dir = $result['DIREMPRE'];
        $condi = $result['COND'];
        $igv = $result['IGV'];
        $USR = $result['USUARIO'];
        $time = $result['HORAREG'];
        $fec = $result['FECREG'];
        $rucdniR = $result['RUCDNIRE'];
        $nombR = $result['NOMBRE'];
        $dirR = $result['DIRERE'];
        $rucdniC = $result['RUCDNICO'];
        $nombC = $result['NOMBCO'];
        $dirC = $result['DIRECO'] ;
        $destino = $result['RUTADES'] ;
        $ODESORI = $result['ODESORI'];
        $placa = $result['PLACA'];
        $lice = $result['LIC'];
        $conductor = $result['CHOFCOND'];
        $sqli = "SELECT * FROM fmovimpfde WHERE DOC1 = '$ndoc'AND IDEM = '$idemXY'";
        $result = $conexion->query($sqli);
        $result = mysqli_fetch_assoc($result);
        $letras = $result['MLETRA'];
        $dirpartida = $result['DIRPARTIDA'];
        $dirllegada = $result['DIRLLEGADA'];
        $Observa = $result['OBSERV'];
        $marca = $result['MARCA'];
        $certifi = $result['CERTIFICADO'];         
        $confivehi = $result['CONFVHEICU'];         
        $peso = $result['PESO'];
        $mensaje = "existe";
        $response = array(
            "idemXY" => $idemXY,
            "Numdoc" => $Numdoc,
            "txtruc" => $txtruc,
            "totbruto" => $totbruto,
            "vvtatot" => $vvtatot,
            "MonIGV" => $MonIGV,
            "totPrecVenta" => $totPrecVenta,
            "Date" => $Date,
            "fecaten" => $fecaten,
            "cliente" => $cliente,
            "dir" => $dir,
            "condi" => $condi,
            "igv" => $igv,
            "USR" => $USR,
            "time" => $time,
            "fec" => $fec,
            "rucdniR" => $rucdniR,
            "nombR" => $nombR,
            "dirR" => $dirR,
            "rucdniC" => $rucdniC,
            "nombC" => $nombC,
            "dirC" => $dirC,
            "destino" => $destino,
            "ODESORI" => $ODESORI,
            "placa" => $placa,
            "lice" => $lice,
            "conductor" => $conductor,
            "Observa" => $Observa,
            "marca" => $marca,
            "letras" => $letras,
            "dirpartida" => $dirpartida,
            "dirllegada" => $dirllegada,
            "certifi" => $certifi,
            "confivehi" => $confivehi,
            "peso" => $peso,
            "mensaje" => $mensaje,
            "table" => $table
        );
        echo json_encode($response);
    } else {
        $idemXY = "";
        $Numdoc = "";
        $txtruc = "";
        $totbruto = "";
        $vvtatot = "";
        $MonIGV = "";
        $totPrecVenta = "";
        $Date = "";
        $fecaten = "";
        $cliente = "";
        $dir = "";
        $condi = "";
        $igv = "";
        $USR = "";
        $time = "";
        $fec = "";
        $rucdniR = "";
        $nombR = "";
        $dirR = "";
        $rucdniC = "";
        $nombC = "";
        $dirC = "";
        $destino = "";
        $ODESORI = "";
        $placa = "";
        $lice = "";
        $conductor = "";
        $Observa = "";
        $marca = "";
        $letras = "";
        $dirpartida = "";
        $dirllegada = "";
        $certifi = "";
        $confivehi = "";
        $peso = "";
        $mensaje = "";
        $table = "";
        $response = array(
            "idemXY" => $idemXY,
            "Numdoc" => $Numdoc,
            "txtruc" => $txtruc,
            "totbruto" => $totbruto,
            "vvtatot" => $vvtatot,
            "MonIGV" => $MonIGV,
            "totPrecVenta" => $totPrecVenta,
            "Date" => $Date,
            "fecaten" => $fecaten,
            "cliente" => $cliente,
            "dir" => $dir,
            "condi" => $condi,
            "igv" => $igv,
            "USR" => $USR,
            "time" => $time,
            "fec" => $fec,
            "rucdniR" => $rucdniR,
            "nombR" => $nombR,
            "dirR" => $dirR,
            "rucdniC" => $rucdniC,
            "nombC" => $nombC,
            "dirC" => $dirC,
            "destino" => $destino,
            "ODESORI" => $ODESORI,
            "placa" => $placa,
            "lice" => $lice,
            "conductor" => $conductor,
            "Observa" => $Observa,
            "marca" => $marca,
            "letras" => $letras,
            "dirpartida" => $dirpartida,
            "dirllegada" => $dirllegada,
            "certifi" => $certifi,
            "confivehi" => $confivehi,
            "peso" => $peso,
            "mensaje" => $mensaje,
            "table" => $table
        );
        echo json_encode($response);
    }
}

// Cerrar la conexión
$conexion->close();
?>