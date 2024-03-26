
<?php
date_default_timezone_set('America/Lima');
# Incluir librerías y establecer conexión #
include_once('../includes/acceso.php');

$conexion = connect_db(); // Establecer conexión con la base de datos

# Obtener datos del código proporcionado #
$cod = $_GET['cod'] ?? '';
$datos = mysqli_query($conexion, "SELECT * FROM fmovimpfd WHERE IDBF = '$cod'");
$parametros = mysqli_query($conexion, "SELECT * FROM ftge2007 WHERE CODI = '14'");
$datos = mysqli_fetch_assoc($datos);
$parametros = mysqli_fetch_assoc($parametros);

# Obtener información relevante de la empresa #
$nombempresa = $parametros['NOMB'] ?? '';
$ruc = $parametros['RUC'] ?? '';
$dire = $parametros['DIRE'] ?? '';
$fono = $parametros['FONO'] ?? '';
$email = $parametros['EMAIL'] ?? '';
$cajero = $datos['NOMBEMP'] ?? '';
$numfac = $datos['DOC1'] ?? '';

mysqli_close($conexion); // Cerrar conexión con la base de datos

require('code128.php');

// Clase extendida de FPDF para agregar código de barras


// Función para leer el archivo CSV y devolver los datos como un array
function leerCSV($archivo) {
    $csv = array_map('str_getcsv', file($archivo));
    $keys = array_shift($csv);
    $datos = array();
    foreach ($csv as $fila) {
        $datos[] = array_combine($keys, $fila);
    }
    return $datos;
}

// Leer datos del archivo CSV
$datos_factura = leerCSV('datos_factura.csv');

// Crear instancia de FPDF
$pdf = new PDF_Code128('P', 'mm', 'A4');
$pdf->SetMargins(17, 17, 17);
$pdf->AddPage();

// Logo de la empresa
$pdf->Image('img/logo.png',10,8,33);

// Configurar fuente
$pdf->SetFont('Arial','B',12);

// Título de la factura
$pdf->Cell(130,5,utf8_decode('SD'),0,0);
$pdf->Cell(59,5,utf8_decode('SD'),0,1); // Salto de línea

// Datos de la factura (RUC, Dirección, Fecha)
$pdf->SetFont('Arial','B',10);
$pdf->Cell(130,5,utf8_decode('RUC: '),0,0);
$pdf->Cell(59,5,utf8_decode('Fecha: '),0,1); // Salto de línea
$pdf->Cell(130,5,utf8_decode('Dirección: '),0,1); // Salto de línea

// Datos del cliente
$pdf->Cell(130,5,utf8_decode('Cliente: '),0,0);
$pdf->Cell(59,5,utf8_decode('Teléfono: '),0,1); // Salto de línea
$pdf->Cell(130,5,utf8_decode('Dirección: '),0,1); // Salto de línea

// Encabezado de la tabla de productos
$pdf->SetFont('Arial','B',10);
$pdf->Cell(90,7,utf8_decode('Descripción'),1,0,'C');
$pdf->Cell(15,7,utf8_decode('Cantidad'),1,0,'C');
$pdf->Cell(25,7,utf8_decode('Precio Unit.'),1,0,'C');
$pdf->Cell(19,7,utf8_decode('Descuento'),1,0,'C');
$pdf->Cell(32,7,utf8_decode('Total'),1,1,'C'); // Salto de línea

// Detalles de los productos
$pdf->SetFont('Arial','B',10);
$total = 0;
foreach ($datos_factura as $producto) {
    $pdf->Cell(90,7,utf8_decode('S'),1,0);
    $pdf->Cell(15,7,utf8_decode('S'),1,0,'C');
    $pdf->Cell(25,7,utf8_decode('$'.' SD'),1,0,'C');
    $pdf->Cell(19,7,utf8_decode('$'.'SD '),1,0,'C');
    $subtotal = 0;
    $pdf->Cell(32,7,utf8_decode('$'),1,1,'C'); // Salto de línea
    $total += $subtotal;
}

// Total
$pdf->Cell(169,7,utf8_decode('Total'),1,0,'C');
$pdf->Cell(32,7,utf8_decode('$'),1,1,'C'); // Salto de línea

// Convertir el total a texto
$total_letras = 'S';

// Total en letras
$pdf->Ln(12);
$pdf->SetFont('Arial','',10);
$pdf->Cell(30,7,utf8_decode('Son: '),0,0);
$pdf->Cell(0,7,utf8_decode('SD'),0,1);

// Condición de venta
$pdf->Ln(9);
$pdf->Cell(40,7,utf8_decode('Condición de venta: '),0,0);
$pdf->Cell(60,7,utf8_decode(''),0,1);

// Observaciones
$pdf->Ln(9);
$pdf->Cell(27,7,utf8_decode('Observaciones: '),0,0);
$pdf->MultiCell(0,7,utf8_decode('SD'),0,'L');

// Generar código de barras
$pdf->Ln(9);
$pdf->Code128(90, 200,'23123' , 50, 10);

// Salida del PDF
$pdf->Output();
?>