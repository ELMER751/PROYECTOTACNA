<?php
date_default_timezone_set('America/Lima');

# Incluir librerías y establecer conexión #
include_once('../includes/acceso.php');
require "code128.php"; // Archivo necesario para generar el PDF

$conexion = connect_db(); // Establecer conexión con la base de datos

# Obtener datos del código proporcionado #
$cod = $_GET['cod'];
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

# Inicializar el objeto PDF #
$pdf = new PDF_Code128('P', 'mm', 'A4');
$pdf->SetMargins(17, 17, 17);
$pdf->AddPage();

# Logo de la empresa formato png #
$pdf->Image('./img/carro.png', 155, 12, 50, 25, 'PNG');

# Encabezado y datos de la empresa #
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(150, 10, iconv("UTF-8", "ISO-8859-1", strtoupper("$nombempresa")), 0, 0, 'L');

$pdf->Ln(9);

$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1", "RUC: $ruc"), 0, 0, 'L');

$pdf->Ln(5);

$pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1", "Direccion: $dire"), 0, 0, 'L');

$pdf->Ln(5);

$pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1", "Teléfono: $fono"), 0, 0, 'L');

$pdf->Ln(5);

$pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1", "Email: $email"), 0, 0, 'L');

$pdf->Ln(10);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 7, iconv("UTF-8", "ISO-8859-1", "Fecha de emisión:"), 0, 0);
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(116, 7, iconv("UTF-8", "ISO-8859-1", date("d/m/Y") . " " . date("h:i:s A")), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(35, 7, iconv("UTF-8", "ISO-8859-1", strtoupper("Factura Nro.")), 0, 0, 'C');

$pdf->Ln(7);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(12, 7, iconv("UTF-8", "ISO-8859-1", "Cajero:"), 0, 0, 'L');
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(134, 7, iconv("UTF-8", "ISO-8859-1", "$cajero"), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(97, 97, 97);
$pdf->Cell(35, 7, iconv("UTF-8", "ISO-8859-1", strtoupper("$numfac")), 0, 0, 'C');
$pdf->Cell(90,7,iconv("UTF-8", "ISO-8859-1","Producto 2"),'L',0,'C');
$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1","5"),'L',0,'C');
$pdf->Cell(25,7,iconv("UTF-8", "ISO-8859-1","$20 USD"),'L',0,'C');
$pdf->Cell(19,7,iconv("UTF-8", "ISO-8859-1","$0.00 USD"),'L',0,'C');
$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","$100.00 USD"),'LR',1,'C');

$pdf->Cell(90,7,iconv("UTF-8", "ISO-8859-1","Producto 3"),'L',0,'C');
$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1","2"),'L',0,'C');
$pdf->Cell(25,7,iconv("UTF-8", "ISO-8859-1","$30 USD"),'L',0,'C');
$pdf->Cell(19,7,iconv("UTF-8", "ISO-8859-1","$0.00 USD"),'L',0,'C');
$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","$60.00 USD"),'LR',1,'C');

$pdf->Cell(90,7,iconv("UTF-8", "ISO-8859-1","Total"),'LB',0,'C');
$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",""),'LB',0,'C');
$pdf->Cell(25,7,iconv("UTF-8", "ISO-8859-1",""),'LB',0,'C');
$pdf->Cell(19,7,iconv("UTF-8", "ISO-8859-1",""),'LB',0,'C');
$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","$230.00 USD"),'LRB',1,'C');

$pdf->Ln(12);

$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(39,39,51);
$pdf->Cell(30,7,iconv("UTF-8", "ISO-8859-1","Son: "),0,0);
$pdf->SetTextColor(97,97,97);
$pdf->Cell(0,7,iconv("UTF-8", "ISO-8859-1","Doscientos treinta y 00/100 Dólares Americanos"),0,0);

$pdf->Ln(9);

$pdf->SetTextColor(39,39,51);
$pdf->Cell(40,7,iconv("UTF-8", "ISO-8859-1","Condición de venta: "),0,0);
$pdf->SetTextColor(97,97,97);
$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1","Crédito"),0,0);

$pdf->Ln(9);

$pdf->SetTextColor(39,39,51);
$pdf->Cell(27,7,iconv("UTF-8", "ISO-8859-1","Observaciones: "),0,0);
$pdf->SetTextColor(97,97,97);
$pdf->MultiCell(0,7,iconv("UTF-8", "ISO-8859-1","Este es un ejemplo de observaciones en la factura."),0,'L');

$pdf->Output();