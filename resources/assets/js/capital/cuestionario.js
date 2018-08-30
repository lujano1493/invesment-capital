$(document).ready(function ($){

	var btnTest = $("#btn-test") ;

	if( btnTest.length == 0 ) {
		return false;
	}
	var  customValidate= btnTest.data("custom-validate");
	btnTest.data(customValidate, function (){
			var preguntas = $(".pregunta_opcion");
			var flgValidate= true;
			$(preguntas).each (function (){
				var  pregunta = $(this),index=pregunta.data("index");

				var checkedElement = pregunta.find(":checked");
				var firstElement = pregunta.find("input:first");
				if( checkedElement.length == 0){
					$("#pregunta_"+index).scrollElement(function (){
						firstElement.tooltip({
							title:"Es necesario seleccionar al menos una opción." ,
							placement:"left",
							trigger:'manual',});
						firstElement.tooltip('show');
						setTimeout(function(){ firstElement.tooltip('hide'); }, 4000);
			 		});
			 		flgValidate=false;
			 		return false;
				}
			});
		return flgValidate;
	});


		
	btnTest.on("done.forms.ajax",function(event, data){
		$("#modalFinalizar").modal({backdrop:'static'});
	});


	$(document).on("change","input:checkbox",function(event){
		var check= $(this),checked = check.prop("checked") , group=  check.closest(".pregunta_opcion");
		 group.find("input:checkbox").prop("checked",false);
		 check.prop("checked",checked);

	});


	

	setInterval( 
			function (){
				var id = $("[name='id']").val();
				var data = $("#cuestionario").serializeForm();
				$.ajax({
						url: '/educacion/cuestionario/guardar/'+id  ,
						method:'POST',
						data:data
					})
			}


		, 1000 * 60 *3);


});