$.fn.serializeForm = function ( options){
	 	var  form =this;
	 	var contentType = form.attr("enctype") || form.attr("accept");
 		var isMultipart=  contentType ==="multipart/form-data";
 		var data = isMultipart ?  new FormData() : {}  ; 	
		form.find("input, select, textarea").each(function(index, el) {
			var input= $(el),name=input.attr("name");	

			if(  (input.is(":checkbox")  ||  input .is(":radio") )  &&  !input.prop("checked")  ){
				return true;
			}

				if(  isMultipart  ){
						var val = input.is("[type='file']")    ?   el.files[0] : input.val();
						data.append( name,   val  );								
				}else{
					data[ name ] = input.val();
					if(input.is("[data-id-value]")){     //checamos si tiene el atributo configurado por anterios llamadas json
						data[ name ] =input.attr("data-id-value");
					}
				}		 		
		});
 	
		 return data;
	};