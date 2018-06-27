

$(document).ready(function (){


});


 $(document).on("blur",".nombre-rfc, .apellido-pat-rfc, .apellido-mat-rfc, .fecha-nac-rfc",function(){
	calculaRFC(".nickname",document);

 } );

 $(document).on("click",".generate-password" ,function (){
 	$(".input-password").val(makeid());
 	return false;
 });

