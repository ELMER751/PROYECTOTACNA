<?php
//include_once('header.php');
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ingresar_sesion.php");
    exit();}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>BUSCA</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	</head>
	<body>
		<?php
			global $tabla;
			$tabla = $_GET['tabla'];
			global $titulo;
			$titulo = $_GET['titulo'] ?? '';
			$response = $_GET['response'] ?? '';
		?>
		<header>
			<div class="alert alert-info">
				<h4 >BUSCAR <?php echo "$titulo";?></h4>
			</div>
		</header>
		<section>
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar..." autofocus>
        </section>
		
		<section id="tabla_resultado">
			<?php
			$pagina=urlencode($_SERVER['PHP_SELF']);
			include 'buscar.php';
			?>
		</section>
		<section>
			<?php if($response === "A"){?>
				<a style="background-color: green; border: 0px solid white;" class="btn btn-info add-new" href="javascript:void(0);" onclick="cerrarPagina()">VOLVER</a>
				<script>
					function cerrarPagina() {
						window.parent.cerrarInterfaz();
					}
				</script>
				<?php } else{?>
				<a style="background-color: green; border: 0px solid white;" class="btn btn-info add-new" href="javascript:history.back()">VOLVER</a>
			<?php
			}?>
		</section>
		<script>
			$(document).ready(function(){
				// Captura el evento keyup en el campo de búsqueda
				$('#busqueda').keyup(function(){
					// Obtiene el valor actual del campo de búsqueda
					var valorBusqueda = $(this).val();
					var tabla = '<?php echo $tabla; ?>';
					var pagina='<?php echo urlencode($_SERVER['PHP_SELF']);?>';
					var titulo='<?php echo $titulo;?>';
					// Realiza la búsqueda solo si el valor no está vacío
					if(valorBusqueda != ""){
						// Realiza la búsqueda mediante AJAX
						$.ajax({
							url: 'buscar.php',
							type: 'POST',
							dataType: 'html',
							data: { busqueda: valorBusqueda, tabla: tabla, pagina: pagina, titulo: titulo },
							success: function(response){
								console.log('Variable tabla enviada correctamente ' + tabla);
								console.log('Variable tabla enviada correctamente ' + pagina);
								console.log('Variable tabla enviada correctamente ' + titulo);
								// Actualiza la sección de resultados con la respuesta del servidor
								$('#tabla_resultado').html(response);
							}
						});
					} else {
						// Si el campo de búsqueda está vacío, borra la tabla de resultados
						$('#tabla_resultado').html('');
					}
				});
			});
		</script>
	</body>
</html>