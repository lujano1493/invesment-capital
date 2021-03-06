$(function() {
	function uploadMultipart(options ,callbacks ){
			
		var request = new XMLHttpRequest();
 		request.open(options.method,  options.url  , true);
		callbacks.before();
 		//App.blockUI({ zIndex: 10000000 });   // animacion de bloqueo

 		request.onreadystatechange = function() { 	 		
 			if(this.readyState ==   XMLHttpRequest.DONE  ){ // complate
				var response=  this.responseText; 				
 				if(  this.status == 200 ){
 					 callbacks.done( $.parseJSON(  response ) );
 				}else {
 					callbacks.fail( response,this.status  );   //TODO lanzar Excepcion
 				}
 				callbacks.always();
 				//App.unblockUI();  //animacion de desbloqueo
 			}
		};
		request.send(options.data);
	}

	function uploadSimple( options,callbacks ){   // peticiones simples de formularios
 		options.beforeSend=callbacks.before
		$.ajax( options )
 			.done( callbacks.done ).fail( callbacks.fail ).
 			always(callbacks.always  );
	}
 $(document).on("click",".btn-ajax",function (event,disableValidate){
 	var  btn=$(this) ,form= btn.closest("form") ,idTmpl=btn.data("id-tmpl"), idTarget= btn.data("target-show"), 
 		customValidation = btn.data("custom-validate"), noShowMsg= !! btn.data("no-show-msg") ;
 	if( !disableValidate){
 		if( !customValidation &&  !form.valid()){
 			return false;
	 	}
	 	if(customValidation &&   !btn.data(customValidation)()   ){
	 		return false;
	 	}
 	}	
 	


 	var contentType = form.attr("enctype") || form.attr("accept");
 	var isMultipart=  contentType ==="multipart/form-data";
	if(  /*$.isOldVersionExplorer() */ -1 !== -1 ){ 
		var fieldIsAjax=  form.find("[name='isAjax']");
		if( fieldIsAjax.length > 0 ){
			fieldIsAjax.val("false");
		}
		else{
			form.append( $("<input/>",{"name":"isAjax","value":"false" ,"type":"hidden"})  );
		}
		form.submit();
		return false;			
	}
 	var data =   form.serializeForm();
	var loading= null;
	var callbacks= {
		before: function(){
		btn.prop("disabled",true);
		loading= new Loading({zIndex:500,title:'Espere un momento'});
		},
		done: function(data) { 	
				if(idTmpl && idTarget  && $(idTmpl).length > 0  &&$(idTarget).length > 0    ){					
					var html=$.tmpl( idTmpl , data  );
	 	    		$(idTarget).html(html).removeClass("invisible");
				}else if(! noShowMsg ){		
					toastr[ data.status ==='ok' ? 'success' :'error' ]  (data.message, data.title ||   ( data.status ==='ok' ?'Proceso satisfactorio.'  : 'Error en el Proceso'));
				}
				btn.trigger("done.forms.ajax",[ data]);
				if( btn.data('clear-form') ){
					form[0].reset();
				}
				if( !data.results ){
					return false;
				}
				for(var name in data.results.inputs){
					form.find("[name='"+name+"']").val( data.results.inputs[name]  );
				}
				if(data.results.change){
					var change=data.results.change;
					$(change).each(function (index,el){

						var content = el.closest && el.closest!=="" ?  form.closest( el.closest) :form;
						var itemFind=  el.selector && el.selector !=="" ? content.find(el.selector) : content;
						if( el.html)
							itemFind.html(el.html);
						if(el.text)
							itemFind.text(el.text);
						if(el.attr){
							for( var attr in el.attr){
								itemFind.attr(attr,  el.attr[attr]);
							}
						}

					});
				}

				
				
	 		},
		fail: function (response,status, errorThrown  ){
			response =  response.responseJSON?  response.responseJSON : {message:response.responseText, title : 'Error Interno de Servidor'  };
			!noShowMsg&& toastr.error(    response.message || response.mesanje    ,    response.title ||  response.titulo  || errorThrown  );

		}, 
		always:function (){
			btn.prop("disabled" ,false);
			loading.out();
		}
	};

 	var _options ={
 		url:    btn.data("url") || form.attr("action")  || "."  ,
 		method:  form.attr("method") || "POST",
 		data: data
 	};
 	if(contentType  && isMultipart ){
 		uploadMultipart(_options,callbacks);		
 		
 	}
 	else {
 		uploadSimple(_options,callbacks);
 	}
 	return false;

 });
});