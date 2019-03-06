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

	var tipoEvaluacion = $("[name='tipo']").val();

	function guardarCuestionario(){
				var id = $("[name='id']").val();
				var data = $("#cuestionario").serializeForm();
				$.ajax({
						url: '/educacion/cuestionario/guardar/'+id  ,
						method:'POST',
						data:data,
						success:function(data){
							var diffTime =data.results.diffTime;
							$("[name='diffTime']").val(diffTime);
							if(diffTime <= 0){
								btnTest.trigger("click", [true]);
								stopInterval();
								clearInterval(intervalGuardar);
							}

						}
					})
			}


	var intervalGuardar= setInterval( guardarCuestionario , 1000);

		if(tipoEvaluacion !=2){
			return false;
		}
		function stopInterval(){
			clearInterval(interval);
			$(".time-test").text(toHHMMSS(0) );
		}
		function refrescaTiempo(){
			var diffTime = + $("[name='diffTime']").val();
			var labelTime= $(".time-test");
			labelTime.text( toHHMMSS(diffTime)    );
			diffTime--;
			$("[name='diffTime']").val(diffTime);
			if(diffTime <= 0){
				btnTest.trigger("click", [true]);
				stopInterval();
			}
		}
		var interval = setInterval( refrescaTiempo,1000);
		var toHHMMSS = (secs) => {
		    var sec_num = parseInt(secs, 10)    
		    var hours   = Math.floor(sec_num / 3600) % 24
		    var minutes = Math.floor(sec_num / 60) % 60
		    var seconds = sec_num % 60    
		    return (hours <10 ? '0':'' )+ hours  +":" + (minutes <10 ? '0':'' ) + minutes+ ":" + (seconds <10 ? '0':'' )+seconds;
		}
});