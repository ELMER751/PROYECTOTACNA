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

	
	# Incluyendo librerias necesarias #
	require "code128.php";

	$pdf = new PDF_Code128('P','mm','A4');
	$pdf->SetMargins(5,10,0);
	$pdf->SetAutoPageBreak(true, 10); // Activar salto de página automático con una distancia de 10 mm desde la parte inferior
	$pdf->AddPage();

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
$posX = 142; // ajusta según sea necesario

// Cuadro dinámico
// Cuadro dinámico
$pdf->Rect($posX, $posY, 65, 22); // Dibuja un rectángulo en la posición y tamaño especificados
$pdf->SetFont('Arial','B',14);
// Ajustar posición de los Cell alineados a la derecha
$posY = 14;
$pdf->SetXY(152, $posY);
$pdf->Cell(50,6,iconv("UTF-8", "ISO-8859-1","R U C  :  $ruc"),0,1,'R'); 

// Ajustar posición de los demás Cell para que estén dentro del cuadro
$pdf->SetXY(125, $posY + 7);
$pdf->Cell(100,6,iconv("UTF-8", "ISO-8859-1","FACTURA ELECTRONICA"),0,1,'C'); 

$pdf->SetXY(125, $posY + 14); // Ajustar posición vertical para el siguiente Cell
$pdf->Cell(100,6,iconv("UTF-8", "ISO-8859-1","F $serie N° $numfac"),0,1,'C'); 

$pdf->SetMargins(7,5,5);	
$pdf->Ln(7);
$pdf->Rect(5, 41, 202, 30); // Dibuja un rectángulo en la posición y tamaño especificados
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(14,7,iconv("UTF-8", "ISO-8859-1","Señor   : "),0,0);
    $pdf->SetTextColor(97,97,97);
	$pdf->Cell(145,7,iconv("UTF-8", "ISO-8859-1","$cliente"),0,0,'L');
    $pdf->SetTextColor(39,39,51);
    $pdf->SetFont('Arial','',10);
	$pdf->Cell(16,7,iconv("UTF-8", "ISO-8859-1","Moneda : "),0,0);
    $pdf->SetTextColor(97,97,97);
	$pdf->Cell(116,7,iconv("UTF-8", "ISO-8859-1","SOLES"),0,0,'L');
	
    $pdf->Ln(7);
    $pdf->SetTextColor(39,39,51);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(12,7,iconv("UTF-8", "ISO-8859-1","RUC  :"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1","$rucE"),0,0,'L');
	$pdf->SetTextColor(39,39,51);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(12,7,iconv("UTF-8", "ISO-8859-1","Fecha :"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(75,7,iconv("UTF-8", "ISO-8859-1",date("d/m/Y")." ".date("h:i:s A")),0,0,'L');
    $pdf->SetTextColor(39,39,51);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(16,7,iconv("UTF-8", "ISO-8859-1","Destino  :"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1","$destino"),0,0,'L');

	$pdf->Ln(7);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","Dómicilio Fiscal   :   "),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1","$direccion"),0,0,'L');

	$pdf->Ln(7);

	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(20,7,iconv("UTF-8", "ISO-8859-1","Condición  :"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(109,7,iconv("UTF-8", "ISO-8859-1","$condi"),0,0);
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
    
    $pdf->SetFont('Arial','',10);
	$pdf->Cell(27,5,iconv("UTF-8", "ISO-8859-1","Observación  : "),0,0);
    $pdf->SetTextColor(97,97,97);
	$pdf->Cell(145,5,iconv("UTF-8", "ISO-8859-1","$observacion"),0,1,'L');
    
    $pdf->SetTextColor(39,39,51);
	$pdf->Cell(10,5,iconv("UTF-8", "ISO-8859-1","SON "),0,0);
    $pdf->SetTextColor(97,97,97);
	$pdf->Cell(145,5,iconv("UTF-8", "ISO-8859-1","$LETRAS"),0,1,'L');
    
    $pdf->SetTextColor(39,39,51);
	$pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","Remitente  : "),0,0);
    $pdf->SetTextColor(97,97,97);
	$pdf->Cell(145,5,iconv("UTF-8", "ISO-8859-1","$remitente"),0,1,'L');
   
    $pdf->SetTextColor(39,39,51);
	$pdf->Cell(21,5,iconv("UTF-8", "ISO-8859-1","Dirección  : "),0,0);
    $pdf->SetTextColor(97,97,97);
	$pdf->Cell(145,5,iconv("UTF-8", "ISO-8859-1","$puntoP"),0,1,'L');
    $pdf->SetTextColor(39,39,51);
	$pdf->Cell(27,5,iconv("UTF-8", "ISO-8859-1","Consignatario  : "),0,0);
    $pdf->SetTextColor(97,97,97);
	$pdf->Cell(145,5,iconv("UTF-8", "ISO-8859-1","$consig"),0,1,'L');
    
    $pdf->SetTextColor(39,39,51);
	$pdf->Cell(24,5,iconv("UTF-8", "ISO-8859-1","Dir. Entrega  : "),0,0);
    $pdf->SetTextColor(97,97,97);
	$pdf->Cell(145,5,iconv("UTF-8", "ISO-8859-1","$puntoL"),0,0,'L');
    $pdf->Ln(10);
	/*----------  Fin Detalles de la tabla  ----------*/


	
	$pdf->SetFont('Arial','B',9);
	
	# Impuestos & totales #
    $pdf->Cell(121,4,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
    $pdf->Cell(15,4,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,4,iconv("UTF-8", "ISO-8859-1","Total gravado :"),'T',0,'C');
	$pdf->Cell(34,4,iconv("UTF-8", "ISO-8859-1","S/. " . number_format($totalg, 2)),'T',0,'C');

	$pdf->Ln(4);

	$pdf->Cell(121,4,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,4,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,4,iconv("UTF-8", "ISO-8859-1","Total No Gravado :"),'',0,'C');
	$pdf->Cell(34,4,iconv("UTF-8", "ISO-8859-1","S/. 00.00"),'',0,'C');

	$pdf->Ln(4);

	$pdf->Cell(121,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');


	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","Total Exonerado"),'T',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","S/. 00.00"),'T',0,'C');

	$pdf->Ln(4);

	$pdf->Cell(121,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","Total IGV 18% :"),'',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","S/. $montoigv"),'',0,'C');

	$pdf->Ln(4);

	$pdf->Cell(121,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","Importe total :"),'',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","S/. " . number_format($precioV, 2)),'',0,'C');

	$pdf->Ln(4);

	$pdf->Cell(121,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","Redondeo : "),'',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","S/. 00.00"),'',0,'C');
    $pdf->Ln(4);

	$pdf->Cell(121,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
	$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","Importe total :"),'',0,'C');
	$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","S/. " . number_format($precioV, 2)),'',0,'C');
	$pdf->Ln(12);

	$pdf->SetFont('Arial','',9);

	$pdf->SetTextColor(39,39,51);
	$pdf->MultiCell(0,3.5,iconv("UTF-8", "ISO-8859-1","Representacion Impresa de la Boleta Electronica
	Podrá ser consultada en : www.transporteexpresotacna.com
  Autorizado mediante resolución :RS 155_2017 ANEXO IV/SUNAT"),0,'C',false);

	$pdf->Ln(9);

	# Codigo de barras #
	$pdf->SetFillColor(39,39,51);
	$pdf->SetDrawColor(23,83,201);
	$pdf->Code128(72,$pdf->GetY(),"COD000001V0001",70,20);
	$pdf->SetXY(12,$pdf->GetY()+21);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","COD000001V0001"),0,'C',false);

	# Nombre del archivo PDF #
	$pdf->Output("I","Factura_F".$serie."N°".$numfac.".pdf",true);
	mysqli_close($conexion);
	?>