

$(document).ready(function (){


});

	// para generar nickname
 $(document).on("blur",".nombre-rfc, .apellido-pat-rfc, .apellido-mat-rfc, .fecha-nac-rfc",function(){
 	var form = $(this).closest('form');
	calculaRFC(".rfc",form);

 } );

 //generar un password aleatorio

 $(document).on("click",".generate-password" ,function (){
 	$(".input-password").val(makeid());
 	return false;
 });

