$(document).ready(function (){


	$(document).on("click",".btn-calcular",function (){
		var btn = $(this),type =btn.data("type"),selectTarget= btn.data("target"), 
			url = btn.data("url"),form = btn.closest("form"), target= form.find( selectTarget);

		if( type === "remote" ){
			var loading= new Loading({zIndex:500,title:'Espere un momento'});
	 			btn.prop("disabled",true);
	 			$.getJSON(  url, function (data){
	 				target.val(data);
	 			}  ).always(function(){
	 				btn.prop("disabled",false);
	 				loading.out();
	 			});

		}
		else if (type === "summation" || type === "sum" ) {
			var selectInputs = btn.data("inputs"),inputs= form.find(selectInputs);
			var total = 0;
			inputs.each(function (index,el){
				var input= $(el), typeCalc= input.data("type-calc");
				var value= input.val();
				total +=  ( typeCalc == "subtraction" || typeCalc == "sub" ? -1 :1   )* value;

			});
			target.val(total);
		}
		else if ( type  == "ValiaPercentage"  || type == "ValiaPercent" ){
			var percent = 1* form.find("[data-type-calc='percent']").val(),value = 1*form.find("[data-type-calc='value']").val();
			var result=  value  + (value* (percent/100));
			target.val(  result.toFixed(2)  );
		}

		else if (type =="valiaInversoPercent"  ){
			var result = 1* form.find("[data-type-calc='result']").val(),value = 1*form.find("[data-type-calc='value']").val();
			var percent =  (100*result/value) -100;
			target.val(  percent.toFixed(2)  );

		}





	});

});