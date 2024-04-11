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
    require "./code128.php";

    $pdf = new PDF_Code128('P','mm',array(80,258));
    $pdf->SetMargins(4,10,4);
    $pdf->AddPage();
    
    # Encabezado y datos de la empresa #
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("$nombempresa")),0,'C',false);
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","RUC: $ruc"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","DIRECCIÓN: $dire"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Arequipa - Arequipa - Arequipa"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","EMAIL: $email"),0,'C',false);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","FECHA: ".date("d/m/Y")." ".date("h:i:s a")),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","CAJERO: $remitente"),0,'C',false);
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("B".$serie."N°".str_pad($numfac, 6, '0', STR_PAD_LEFT)."")),0,'C',false);
    $pdf->SetFont('Arial','',9);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","CLIENTE: $cliente"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Documento: DNI $rucE"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Teléfono: 00000000"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Dirección: San Salvador, El Salvador, Centro America"),0,'C',false);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(3);

    # Tabla de productos #
    $pdf->Cell(10,5,iconv("UTF-8", "ISO-8859-1","Cant."),0,0,'C');
    $pdf->Cell(19,5,iconv("UTF-8", "ISO-8859-1","Precio"),0,0,'C');
    $pdf->Cell(15,5,iconv("UTF-8", "ISO-8859-1","Desc."),0,0,'C');
    $pdf->Cell(28,5,iconv("UTF-8", "ISO-8859-1","Total"),0,0,'C');

    $pdf->Ln(3);
    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(3);



    /*----------  Detalles de la tabla  ----------*/
    $pdf->MultiCell(0,4,iconv("UTF-8", "ISO-8859-1","Nombre de producto a vender"),0,'C',false);
    $pdf->Cell(10,4,iconv("UTF-8", "ISO-8859-1","7"),0,0,'C');
    $pdf->Cell(19,4,iconv("UTF-8", "ISO-8859-1","$10 USD"),0,0,'C');
    $pdf->Cell(19,4,iconv("UTF-8", "ISO-8859-1","$0.00 USD"),0,0,'C');
    $pdf->Cell(28,4,iconv("UTF-8", "ISO-8859-1","$70.00 USD"),0,0,'C');
    $pdf->Ln(4);
    $pdf->MultiCell(0,4,iconv("UTF-8", "ISO-8859-1","Garantía de fábrica: 2 Meses"),0,'C',false);
    $pdf->Ln(7);
    /*----------  Fin Detalles de la tabla  ----------*/



    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');

        $pdf->Ln(5);

    # Impuestos & totales #
    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","SUBTOTAL"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","+ $70.00 USD"),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","IVA (13%)"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","+ $0.00 USD"),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","TOTAL A PAGAR"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","$70.00 USD"),0,0,'C');

    $pdf->Ln(5);
    
    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","TOTAL PAGADO"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","$100.00 USD"),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","CAMBIO"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","$30.00 USD"),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","USTED AHORRA"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","$0.00 USD"),0,0,'C');

    $pdf->Ln(10);

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar este ticket ***"),0,'C',false);

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(0,7,iconv("UTF-8", "ISO-8859-1","Gracias por su compra"),'',0,'C');

    $pdf->Ln(9);

    # Codigo de barras #
    $pdf->Code128(5,$pdf->GetY(),"COD".str_pad($numfac, 6, '0', STR_PAD_LEFT)."V".$serie."",70,20);
    $pdf->SetXY(0,$pdf->GetY()+21);
    $pdf->SetFont('Arial','',14);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","COD".str_pad($numfac, 6, '0', STR_PAD_LEFT)."V".$serie.""),0,'C',false);
    
    # Nombre del archivo PDF #
    $pdf->Output("I","Boleta".$serie."N°".str_pad($numfac, 6, '0', STR_PAD_LEFT).".pdf",true);
	mysqli_close($conexion);
    ?>