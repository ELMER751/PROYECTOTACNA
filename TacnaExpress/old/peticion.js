$(obtener_registros());

function obtener_registros(_camiones)
{
	$.ajax({
		url : 'consulta.php',
		type : 'POST',
		dataType : 'html',
		data : { _camiones: _camiones },
		})

	.done(function(resultado){
		$("#tabla_resultado").html(resultado);
	})
}

$(document).on('keyup', '#busqueda', function()
{
	var valorBusqueda=$(this).val();
	if (valorBusqueda!="")
	{
		obtener_registros(valorBusqueda);
	}
	else
		{
			obtener_registros();
		}
});