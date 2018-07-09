(function($){	
	$.fn.filterForm=function (context,options){
		var form = $(this ||context );
		/** Si no es un form lo buscamos en los ancestros */
		if (!form.is("form")  ){
			form = form.closest("form");
		}
		var inputs= form.find(".filter-form");
		/**si no hay input con la clase filter-form buscamos diractamente */
		if(inputs.length ===0 ){
			inputs = form.find("input, textarea, select");
		}		
		var params={};
		inputs.each(function (index, val){
			var input= $(this);

			if( input.prop("disabled") ){
				return true;
			}

			var	name=  input.attr("id") || input.attr("name") || input.data("name") ,
				value= input.val();

			params[name] = value;
		});
		return params;
	};
}) (jQuery) ;