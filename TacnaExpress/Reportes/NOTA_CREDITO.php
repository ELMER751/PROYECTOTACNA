<?php
	date_default_timezone_set('America/Lima');
	include_once('../includes/acceso.php');
	$conexion = connect_db();
	$cod=$_GET['cod'];
	$datos = mysqli_query($conexion,"SELECT * FROM fmovimpfd WHERE IDBF = '$cod'");
	$parametros = mysqli_query($conexion,"SELECT * FROM ftge2007 WHERE CODI = '14'");
	$datos = mysqli_fetch_assoc($datos);
	$parametros = mysqli_fetch_assoc($parametros);
	$nombempresa = $parametros['NOMB'] ?? '';
	$ruc = $parametros['RUC'] ?? '';
	$dire = $parametros['DIRE'] ?? '';
	$fono = $parametros['FONO'] ?? '';
	$email = $parametros['EMAIL'] ?? '';
	$cliente = $datos['NOMBEMP'] ?? '';
	$numfac = $datos['DOC1'] ?? '';
    $serie = $datos['IDEM2'] ?? '';
    $rucE = $datos['RUC'];
    $destino = $datos['DESTINO'] ?? '';
    $destino = mysqli_query($conexion,"SELECT * FROM ruta WHERE CODIGO = '$destino'");
    $destino = mysqli_fetch_assoc($destino);
    $destino = $destino['DESTINO'] ?? '';
    $direccion = $datos['DIREEMP'] ?? '';
    $condi = $datos['CONDI'] ?? '';
    $condi = mysqli_query($conexion,"SELECT * FROM condiciones WHERE CODI = '$condi'");
    $condi = mysqli_fetch_assoc($condi);
    $condi = $condi['NOMB'] ?? ''; 
    $observacion = $datos['OBSERV'] ?? '';
    $LETRAS = $datos['MLETRA'] ?? '';
    $remitente = $datos['NOMBRE'] ?? '';
    $consig = $datos['NOMBC'] ?? '';
    $puntoP = $datos['DIRERE'] ?? '';
    $puntoL = $datos['DIREC'] ?? '';
    $totalg = $datos['TOTALVENTA'] ?? '';
    $montoigv = $datos['MONTOIGV'] ?? '';
    $precioV = $datos['PRECIOVETA'] ?? '';
	$fec2 = $datos['FECEMI'] ?? '';
	$facele = $datos ['DOC2'] ?? '';
	$movi = $datos['OBSERV'] ?? '';
	$movi = mysqli_query($conexion,"SELECT * FROM motivonc WHERE CODMNC = '$movi'");
	$movi = mysqli_fetch_assoc($movi);
	$movi = $movi['MOTIVONC'] ?? '';
	
	# Incluyendo librerias necesarias #
	require "code128.php";

	$pdf = new PDF_Code128('P','mm','A4');
	$pdf->SetMargins(5,10,0);
	$pdf->SetAutoPageBreak(true, 10); // Activar salto de página automático con una distancia de 10 mm desde la parte inferior
	$pdf->AddPage();
	$pdf->Rect(5, 9, 202, 36);
	# Logo de la empresa formato png #
	$pdf->Image('./img/carro.png',10,12,50,25,'PNG');

    $pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(190,10,iconv("UTF-8", "ISO-8859-1",strtoupper("$nombempresa")),0,1,'C'); // Empresa centrada

$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(39,39,51);
 // Desactivar salto de página automático
$pdf->SetMargins(5, 0, 0); // Establecer los márgenes globales de la página a 0

$pdf->Cell(190,3,iconv("UTF-8", "ISO-8859-1","$dire"),0,1,'C'); // Datos centrados

$pdf->Cell(190,3,iconv("UTF-8", "ISO-8859-1","Arequipa - Arequipa - Arequipa"),0,1,'C'); // Datos centrados

$pdf->Cell(190,3,iconv("UTF-8", "ISO-8859-1","TACNA: Calle Mollendo N° 59 - Tacna - Tacna - Tacna"),0,1,'C'); // Datos centrados

$pdf->Cell(190,3,iconv("UTF-8", "ISO-8859-1","ILO: Calle Callao N° 642 - Ilo - Ilo - Ilo"),0,1,'C'); // Datos centrados

// Obtener la altura de la imagen
$alturaImagen = 25; // ajusta según sea necesario

// Calcular posición Y del cuadro dinámico
$posY = 12; // ajusta según sea necesario

// Calcular posición X de los Cell alineados a la derecha
$posX = 145; // ajusta según sea necesario

// Cuadro dinámico
// Cuadro dinámico
$pdf->Rect($posX, $posY, 60, 22); // Dibuja un rectángulo en la posición y tamaño especificados
$pdf->SetFont('Arial','B',14);
// Ajustar posición de los Cell alineados a la derecha
$posY = 14;
$pdf->SetXY(152, $posY);
$pdf->Cell(50,6,iconv("UTF-8", "ISO-8859-1","R U C  :  $ruc"),0,1,'R'); 

// Ajustar posición de los demás Cell para que estén dentro del cuadro
$pdf->SetXY(125, $posY + 7);
$pdf->Cell(100,6,iconv("UTF-8", "ISO-8859-1","NOTA DE CREDITO"),0,1,'C'); 

$pdf->SetXY(125, $posY + 14); // Ajustar posición vertical para el siguiente Cell
$pdf->Cell(100,6,iconv("UTF-8", "ISO-8859-1"," $serie N° $numfac"),0,1,'C'); 


$pdf->SetMargins(7,5,5);
$pdf->Ln(3);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1","Fecha de Emisión   : "),0,0);
    $pdf->SetTextColor(97,97,97);
	$pdf->Cell(145,7,iconv("UTF-8", "ISO-8859-1","".date("d/m/Y")),0,0,'L');
    $pdf->SetTextColor(39,39,51);	
$pdf->Ln(11);
$pdf->Rect(5, 47, 202, 30); // Dibuja un rectángulo en la posición y tamaño especificados
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(38,7,iconv("UTF-8", "ISO-8859-1","Factura Electronica   : "),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(110,7,iconv("UTF-8", "ISO-8859-1","$facele"),0,0,'L');
	$pdf->SetTextColor(39,39,51);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(29,7,iconv("UTF-8", "ISO-8859-1","Fecha Factura   : "),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(116,7,iconv("UTF-8", "ISO-8859-1","$fec2"),0,0,'L');

	$pdf->Ln(5);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(22,7,iconv("UTF-8", "ISO-8859-1","Señor(es)   : "),0,0);
    $pdf->SetTextColor(97,97,97);
	$pdf->Cell(126,7,iconv("UTF-8", "ISO-8859-1","$cliente"),0,0,'L');
    $pdf->SetTextColor(39,39,51);
    $pdf->SetFont('Arial','',10);
	$pdf->Cell(16,7,iconv("UTF-8", "ISO-8859-1","Moneda : "),0,0);
    $pdf->SetTextColor(97,97,97);
	$pdf->Cell(116,7,iconv("UTF-8", "ISO-8859-1","SOLES"),0,0,'L');
	
    $pdf->Ln(5);
    $pdf->SetTextColor(39,39,51);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(22,7,iconv("UTF-8", "ISO-8859-1","RUC           :"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1","$rucE"),0,0,'L');

	$pdf->Ln(5);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(22,7,iconv("UTF-8", "ISO-8859-1","Dirección    :   "),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1","$direccion"),0,0,'L');

	$pdf->Ln(5);

	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(22,7,iconv("UTF-8", "ISO-8859-1","Motivo        :"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(109,7,iconv("UTF-8", "ISO-8859-1","$movi"),0,0);
    $pdf->SetMargins(5,5,5);

	$pdf->Ln(13);
	# Tabla de productos #
	$pdf->SetFont('Arial','',8);
	$pdf->SetFillColor(23,83,201);
	$pdf->SetDrawColor(23,83,201);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(111,8,iconv("UTF-8", "ISO-8859-1","Descripción"),1,0,'C',true);
	$pdf->Cell(15,8,iconv("UTF-8", "ISO-8859-1","Cantidad"),1,0,'C',true);
	$pdf->Cell(25,8,iconv("UTF-8", "ISO-8859-1","Precio U."),1,0,'C',true);
	$pdf->Cell(19,8,iconv("UTF-8", "ISO-8859-1","P.IGV."),1,0,'C',true);
	$pdf->Cell(32,8,iconv("UTF-8", "ISO-8859-1","Importe"),1,0,'C',true);

	$pdf->Ln(8);

	
	$pdf->SetTextColor(39,39,51);


    $reg = mysqli_query($conexion,"SELECT * FROM fmovimpfd WHERE IDBF = '$cod'");
	/*----------  Detalles de la tabla  ----------*/
    $OTA =mysqli_fetch_all($reg, MYSQLI_ASSOC);
    $longitud = count($OTA); // Obtener la longitud total del arreglo

    foreach ($reg as $indice => $productos) {
        $nombreP = $productos['DESCP'] ?? '';
        $cantidadP = $productos['CANT'] ?? '';
        $precioP = $productos['PUNIT'] ?? '';
        $pigvP = $productos['TOTBRUTO'] ?? '';
        $ptotalP = $productos['PTOTA'] ?? '';

        $pdf->Cell(111, 7, iconv("UTF-8", "ISO-8859-1", "$nombreP"), 'LT', 0, 'C');
        $pdf->Cell(15, 7, iconv("UTF-8", "ISO-8859-1", "$cantidadP"), 'LT', 0, 'C');
        $pdf->Cell(25, 7, iconv("UTF-8", "ISO-8859-1", "$precioP"), 'LT', 0, 'C');
        $pdf->Cell(19, 7, iconv("UTF-8", "ISO-8859-1", "$pigvP"), 'LT', 0, 'C');
        
        // Verificar si es el último elemento del arreglo
        if ($indice == $longitud - 1) {
            $pdf->Cell(32, 7, iconv("UTF-8", "ISO-8859-1", "$ptotalP"), 'LTR', 0, 'C'); // Último elemento
        } else {
            $pdf->Cell(32, 7, iconv("UTF-8", "ISO-8859-1", "$ptotalP"), 'LTR', 1, 'C'); // No último elemento

        }
    }
    $pdf->Ln(7);
    $pdf->Cell(121,7,iconv("UTF-8", "ISO-8859-1",''),'T',0,'C');
    $pdf->Cell(81,7,iconv("UTF-8", "ISO-8859-1",''),'T',0,'C');
	
    $pdf->Ln(7);

    $pdf->SetTextColor(39,39,51);
	$pdf->Cell(10,5,iconv("UTF-8", "ISO-8859-1","SON "),0,0);
    $pdf->SetTextColor(97,97,97);
	$pdf->Cell(145,5,iconv("UTF-8", "ISO-8859-1","$LETRAS"),0,1,'L');

	/*----------  Fin Detalles de la tabla  ----------*/


	
	$pdf->SetFont('Arial','B',9);
	
# Impuestos & totales #
$pdf->Cell(121,4,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(15,4,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(32,4,iconv("UTF-8", "ISO-8859-1","Total gravado :"),'T',0,'L');
$pdf->Cell(34,4,iconv("UTF-8", "ISO-8859-1","S/. " . number_format($totalg, 2)),'T',0,'R');

$pdf->Ln(4);

$pdf->Cell(121,4,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(15,4,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(32,4,iconv("UTF-8", "ISO-8859-1","Total No Gravado :"),'',0,'L');
$pdf->Cell(34,4,iconv("UTF-8", "ISO-8859-1","S/. 00.00"),'',0,'R');

$pdf->Ln(4);

$pdf->Cell(121,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","Total Exonerado :"),'T',0,'L');
$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","S/. 00.00"),'T',0,'R');

$pdf->Ln(4);

$pdf->Cell(121,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","Total IGV 18% :"),'',0,'L');
$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","S/. " . number_format($montoigv, 2)),'',0,'R');

$pdf->Ln(4);

$pdf->Cell(121,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","Importe total :"),'',0,'L');
$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","S/. " . number_format($precioV, 2)),'',0,'R');

$pdf->Ln(4);

$pdf->Cell(121,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","Redondeo : "),'',0,'L');
$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","S/. 00.00"),'',0,'R');

$pdf->Ln(4);

$pdf->Cell(121,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'L');
$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","Importe total :"),'',0,'L');
$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","S/. " . number_format($precioV, 2)),'',0,'R');
	$pdf->Ln(12);

	$pdf->SetFont('Arial','',9);

	$pdf->SetTextColor(39,39,51);
	$pdf->MultiCell(0,3.5,iconv("UTF-8", "ISO-8859-1","Representacion Impresa de la Nota de Credito Electronica
	Podrá ser consultada en : www.transporteexpresotacna.com
  Autorizado mediante resolución :RS 155_2017 ANEXO IV/SUNAT"),0,'C',false);

	$pdf->Ln(9);

	# Codigo de barras #
	$pdf->SetFillColor(39,39,51);
	$pdf->SetDrawColor(23,83,201);
	$pdf->Code128(72,$pdf->GetY(),"COD".str_pad($numfac, 6, '0', STR_PAD_LEFT)."V".$serie."",70,20);
	$pdf->SetXY(12,$pdf->GetY()+21);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","COD".str_pad($numfac, 6, '0', STR_PAD_LEFT)."V".$serie.""),0,'C',false);

	# Nombre del archivo PDF #
	$pdf->Output("I","Nota_Credito_".$serie."N°".$numfac.".pdf",true);
	mysqli_close($conexion);
	?>