<?php
include_once('Clases/Camion.php');
session_start();
include_once('includes/acceso.php');
$conexion = connect_db();       
if ($conexion->connect_errno)
{
	die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
}

//////////////// VALORES INICIALES ///////////////////////

$tabla="";
$query="SELECT * FROM camiones ORDER BY CODIGO";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['_camiones']))
{
	$q=$conexion->real_escape_string($_POST['_camiones']);
	$query="SELECT * FROM camiones WHERE 
		CODIGO LIKE '%".$q."%' OR
		PLACA LIKE '%".$q."%' OR
		MARCA LIKE '%".$q."%' OR
		CERTIFICADO LIKE '%".$q."%' OR
        CONFIGURACION_VEHICULAR LIKE '%".$q."%' OR
		CARGA_MAXIMA LIKE '%".$q."%'";

}

$buscarAlumnos=$conexion->query($query);
if ($buscarAlumnos->num_rows > 0)
{
	$tabla.= 
	'<table class="table table-bordered">
		<tr class="bg-primary">
			<td>CODIGO</td>
			<td>PLACA</td>
			<td>MARCA</td>
			<td>CERTIFICADO</td>
			<td>CONFIGURACION VEHICULAR</td>
            <td>CARGA MAXIMA</td>
            <td></td>
		</tr>';

	while($filaAlumnos= $buscarAlumnos->fetch_assoc())
	{   
        $id=$filaAlumnos['CODIGO'];
		$tabla.=
		'<tr>
			<td>'.$filaAlumnos['CODIGO'].'</td>
			<td>'.$filaAlumnos['PLACA'].'</td>
			<td>'.$filaAlumnos['MARCA'].'</td>
			<td>'.$filaAlumnos['CERTIFICADO'].'</td>
			<td>'.$filaAlumnos['CONFIGURACION_VEHICULAR'].'</td>
            <td>'.$filaAlumnos['CARGA_MAXIMA'].'</td>
            <td><a class="btn btn-info add-new" href="camiones_modifica.php?codigo='.$id.'">SELECCIONAR</a></td>
		 </tr>
		';
	}

	$tabla.='</table>';
} else
	{
		$tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
	}


echo $tabla;
?>
