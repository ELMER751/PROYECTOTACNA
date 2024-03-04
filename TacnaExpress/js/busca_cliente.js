$(obtener_registros());

function obtener_registros(_cliente)
{
	$.ajax({
		url : 'busca_cliente.php',
		type : 'POST',
		dataType : 'html',
		data : { _cliente: _cliente },
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