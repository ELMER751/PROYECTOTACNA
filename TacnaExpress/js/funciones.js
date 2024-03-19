function Cientos(cie) {
    var UNIDAD = ["", "UNO", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE", "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE"];
    var cienes = ["", "DIEZ", "VEINTE", "TREINTA", "CUARENTA", "CINCUENTA", "SESENTA", "SETENTA", "OCHENTA", "NOVENTA"];
    var Pp = "";
    var temp = 0;
    var valor = cie;

    if (cie > 99) {
        temp = Math.floor(valor / 100);
        if (temp === 1) {
            Pp = "CIENTO";
        } else {
            Pp = UNIDAD[temp] + " CIENTOS";
            if (temp === 5) Pp = "QUINIENTOS ";
        }
        if (valor === 100) Pp = "CIEN";
        valor = valor - temp * 100;
    }
    if (valor >= 20 && valor < 30) {
        temp = valor - 20;
        if (valor === 20) {
            Pp = Pp + " VEINTE";
        } else {
            Pp = Pp + " VEINTI" + UNIDAD[temp];
        }
        valor = 0;
    }
    if (valor >= 16 && valor < 20) {
        temp = valor - 10;
        Pp = Pp + "DIESI" + UNIDAD[temp];
        valor = 0;
    }
    if (valor >= 30) {
        temp = Math.floor(valor / 10);
        Pp = Pp + " " + cienes[temp];
        valor = valor - temp * 10;
        if (valor > 0) Pp = Pp + " Y ";
    }
    if (valor > 0) Pp = Pp + " " + UNIDAD[valor];
    return Pp;
}

function EnLetras(monto, moneda) {
    var entero = Math.floor(monto);
    var decimal1 = "";
    var Tempo = 0;
    var Pal = "";
    var Gg = "";

    if (moneda === "S/.") {
        decimal1 = (Math.round((monto - entero) * 100) + "/100 NUEVOS SOLES");
    } else {
        decimal1 = (Math.round((monto - entero) * 100) + "/100 DOLARES AMERICANOS");
    }

    if (monto >= 1000) {
        Tempo = Math.floor(monto / 1000);
        if (Tempo === 1) {
            Pal = "MIL ";
        } else {
            Pal = Cientos(Tempo) + " MIL ";
        }
        entero = entero - Tempo * 1000;
    }
    Gg = Cientos(entero);
    if (entero === 0 && Pal === "") Gg = "CERO";
    return Pal + Gg + " CON " + decimal1;
}

function ApiRucDni(dniru) {
    return new Promise(function(resolve, reject) {
        var xhr = new XMLHttpRequest();
        var URLDNI = "proxy.php?numero=" + dniru;
        var URLRUC = "proxy.php?numero=" + dniru;
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200 || xhr.status === 201) {
                    var responseData = JSON.parse(xhr.responseText);
                    console.log(responseData);
                    alert("Cliente Encontrado");
                    var nomb = responseData.nombre || '';
                    var dire = responseData.direccion || 'Arequipa';
                    resolve({ nomb: nomb, dire: dire });
                } else {
                    alert("No se encontraron datos");
                    reject("No se encontraron datos");
                }
            }
        };
        xhr.onerror = function() {
            alert("Ocurrió un error en la solicitud");
            reject("Ocurrió un error en la solicitud");
        };
        if (dniru.length === 8) {
            xhr.open("GET", URLDNI, true);
        } else if (dniru.length === 11) {
            xhr.open("GET", URLRUC, true);
        } else {
            alert("Consulta no válida");
            reject("Consulta no válida");
            return; // Salir de la función ApiRucDni después de rechazar la promesa
        }
        xhr.send();
    });
}
