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

	 $(document).on("after.forms.add","#btnAgregaSaldos",function(event,selectorTarget,tmpl){
	 	var btn=$(this), ddPosition= btn.data('add-position') ||'last';
	 	var selector = ddPosition =='last' ? 'nth-last-child(2)' :'nth-child(2)';
	 	var lastForm =  $( selectorTarget+" .tmpl-item:" +selector);
	 	lastForm.find("[name]").each(function(){
	 		var input = $(this), name= input.attr("name") ,value= input.val();
	 		if(value && value.length > 0 &&  name  != 'id'  && name != 'count'){
	 			tmpl.find("[name='"+name+"']").val(value)
	 		}

	 	});
	 });

	 $(document).on("done.forms.ajax",".btn-trans",function(event,data){
	 	var btn =$("#btnAgregaSaldos"),ddPosition= btn.data('add-position') ||'last';
	 	var selector = ddPosition =='last' ? 'last' :'first';
	 	var lastForm =  $("#balances .tmpl-item:" +selector);
	 	var balance = data.results.balance;

	 	if( !!balance ){
	 		return false;
	 	}	


	 	var inputs =[];
	 	for(var x in balance ){
	 		var value = balance[x];
	 		var input = lastForm.find("[name='"+x+"']");

	 		input.val(value);
	 		input.addClass("change-input-sucess",1000);
	 		inputs.push(input);
	 	}

	 	setTimeout(function (){
	 		$(inputs).each(function (){
	 			this.removeClass("change-input-sucess",1000);
	 		});


	 	}, 5000);

	 	

	 });

});



