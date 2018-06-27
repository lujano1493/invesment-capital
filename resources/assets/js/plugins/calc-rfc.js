function makeid( length ) {

	length = length || 10;
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!$&";

  for (var i = 0; i < length; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}



function calculaRFC( selectRFC, scope) {

	scope = scope || document;

	function quitaArticulos(palabra) {
		return palabra.replace("DEL ", "").replace("LAS ", "").replace("DE ",
				"").replace("LA ", "").replace("Y ", "").replace("A ", "");
	}
	function esVocal(letra) {
		if (letra == 'A' || letra == 'E' || letra == 'I' || letra == 'O'
				|| letra == 'U' || letra == 'a' || letra == 'e' || letra == 'i'
				|| letra == 'o' || letra == 'u')
			return true;
		else
			return false;
	}
	nombre = $(".nombre-rfc").val().toUpperCase();
	apellidoPaterno = $(".apellido-pat-rfc").val().toUpperCase();
	apellidoMaterno = $(".apellido-mat-rfc").val().toUpperCase();
	fecha = $(".fecha-nac-rfc").val();

	var rfc = "";
	apellidoPaterno = quitaArticulos(apellidoPaterno);
	apellidoMaterno = quitaArticulos(apellidoMaterno);
	rfc += apellidoPaterno.substr(0, 1);
	var l = apellidoPaterno.length;
	var c;
	for (i = 0; i < l; i++) {
		c = apellidoPaterno.charAt(i);
		if (esVocal(c)) {
			rfc += c;
			break;
		}
	}
	var fec= fecha.split("-");

	rfc += apellidoMaterno.substr(0, 1);
	rfc += nombre.substr(0, 1);
	if(fec.length ===3 ){
		rfc +=  fec[2];
		rfc += fec[1];
		rfc += fec[0].substr(2);

	}

	// rfc += "-" + homclave;
	 $(scope).find(selectRFC).val(rfc);
}