$(obtener_registros());

function obtener_registros(_dato, _tabla)
{
	$.ajax({
		url : 'buscar.php',
		type : 'POST',
		dataType : 'html',
		data: { _dato: _dato, _tabla: _tabla}, // Pasar _dato y tabla como datos
		})

	.done(function(resultado){
		$("#tabla_resultado").html(resultado);
	})
}

$(document).on('keyup', '#busqueda', function()
{
	var valorBusqueda = $(this).val();
    if (valorBusqueda != "") {
        obtener_registros(valorBusqueda, tabla); // Pasar valor de búsqueda y nombre de tabla
    } else {
        obtener_registros("", tabla); // Si no hay búsqueda, enviar cadena vacía
    }
});
