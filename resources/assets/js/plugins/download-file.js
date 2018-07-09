(function ($){

	function  getNameFile(xhr){
		  var fileNameFinal = xhr.getResponseHeader("content-disposition");
		    	  var _fileName= fileNameFinal.split("filename =");
		    	   fileNameFinal = _fileName.length >= 1  ? _fileName[1].replace(";","").trim() : false;
		return fileNameFinal;
	}

	/** 
		url - Ruta o rutas del servidor 
		params - parametros a enviar al servidor
		options - opciones
				{
						asyn - si es asincrona o no  true|false
						method - si es POST o GET
						type   - tipo de archivo a descargar
				}
	*/

	$.downloadFileAjax= function ( url,params ,options   ){
		var _options={
			method:'GET',
			async:true,
			type:'default'
		}
		options= $.extend(true ,_options,  options || {}  );
		var xhr = new XMLHttpRequest();
		App.blockUI();
		var blob=null;
	    xhr.open(  options.method ,  $.createURLSURA(url,params )  , options.async);
	    xhr.responseType = 'blob';
	    xhr.onload = function(e) {
	      if( this.readyState !=   XMLHttpRequest.DONE ){
	      	return ;
	      }
	      if (this.status == 200) {
	    	  App.unblockUI();
	    	  var contentTypes= {
					pdf:{
						typeContent:'application/pdf',
						ext:'pdf'
					},
					excel:{
						typeContent:'application/xlsx',
						ext:'xlsx'
					},
					default:{
						typeContent:'',
						ext:''
					}
				};
	    	  var blob = new Blob([this.response], {type:  contentTypes[options.type].typeContent  });		 
	    	  var fileNameFinal=getNameFile(this);  // obtenemos el nombre enviado del servidor		   
	    	  if(!fileNameFinal){ // si no se obtiene se genera un nombre desde el navegador
	    	  	fileNameFinal=fileName  +"." +  contentTypes[options.type].ext;
	    	  }   	  
	    	  if(window.navigator  &&  $.isFunction(window.navigator.msSaveBlob) ){
	    	  	  window.navigator.msSaveBlob(blob, fileNameFinal);
	    	  }else{
	    	  	  var link = document.createElement('a');
		    	  link.href = window.URL.createObjectURL(blob);
		    	  link.download = fileNameFinal ;
		    	  document.body.appendChild(link);
		    	  link.click();
	    	  }
	      }
	      else{	      	
				var reader = new FileReader();
				reader.onload = function(evt) {
				var  status= {};      
			      try{
			        status= $.parseJSON( this.result   );
			      } catch ( err){
			        var codeError = {
			          "500": "Error Interno de Servidor",  
			          "400": "Peticion Incorrecta",
			          "401": "No autorizado",
			          "404": "Solicitud no encontrada"
			         }
			        status.message = err +"";
			        status.title =  codeError[ status ]|| "Error Desconocido";
			      }
			      toastr[  status.code == 300 ?"warning" :"error" ]
			      	(    status.message || status.mesanje    ,    status.title ||  status.titulo  );
			      App.unblockUI();
								  
				};
				reader.readAsText(this.response);
	      }
	    };
	 	xhr.setRequestHeader("Alternative-Response" , "JSON");
	    xhr.send();
	};

	$.downloadFileDirect= function (url, params){
		var urlDownload=url + "?" + $.createURLSURA(url,params );
		if(window.location){
			window.location.href=  urlDownload;
		}
		else{
			location.href=  urlDownload;
		}

	};

	$(document).on("click",".download-file",function(event){	
			event.preventDefault();			// elimina
			var $this= $(this);
			var tipo= $this.data("type");
			var fileName= $this.data("file-name");
			var urls= $this.attr("href") || '';   // dividimos 				
			var idFilters= $this.data("id-filters");
			var form=   !!idFilters  && $(idFilters).length >0 ?  $(idFilters) :  $this.closest('form')  ;
			/** validamos los datos del formulario  */
			if ( ! form.valid() ){
				return ;
			}
			urls =  urls.split(',');
			var params=  form.filterForm() ; 
			/** verificamos que el navegador se los mas actuales */
			$(urls).each(function(index, url) {
				url= url.trim();
				/**Si la version es actual utlizaremos el plugin ajax */
				if(  $.isOldVersionExplorer()  === -1 ){
					$.downloadFileAjax(url,params,{
						method:'GET',
						async: true,
						type:tipo
					});
				}
				/**Si es una version antigua de internet explorer se descargara directamente */
				else{
					$.downloadFileDirect( url,params );
				}
				
			});			
		    return ;    
      });


})(jQuery);