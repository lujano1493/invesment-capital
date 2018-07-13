$(document).ready(function (){


 
 $(document).on("click",".add-form",function (){
 	var btn= $(this),form=btn.closest('form') , target = btn.data('target')
 	, idTmpl=btn.data('id-tmpl') , type= btn.data('type') , count =$(target).find(".tmpl-item").length , 
 	titleHead= btn.data('title-head') || ('Nuevo Registro ' + count), idName = btn.data("id-name"), idValue= btn.attr("data-id-value");

 	var 	tmplHTML =  '';
 	tmplHTML=$.tmpl(idTmpl,{count:count});
 	if( type  === 'accordion'){
 		tmplHTML =  $.tmpl('#tmpl-accordion-add', {targetContent: target+'_'+count ,titleHead: titleHead, target:target ,body : tmplHTML })
 	}
 	tmplHTML = $(tmplHTML);

 	var idInput= tmplHTML.find( "[name='"+idName+"']" );
 	if( idInput.val() ==null  || idInput.val().length ==0 ){
 		idInput.val(  idValue );
 	}
 	
 	tmplHTML.addClass('tmpl-item');
 	 var form = tmplHTML.is("form") ? tmplHTML :tmplHTML.find("form");
 		form.find("[id]").each(function (){
 		var  item=$(this),id = item.attr("id");
 		item.attr("id", id+"_"+count );

 	});

 	$(target).append( tmplHTML);

 	$(tmplHTML).scrollElement(function (){
 		if(  type ==='accordion' ){
		 		$(target).find("[data-toggle='collapse']:last").click();
		 }
 	});
 	

 	return false;
 });


 $(document).on("click",".btn-delete-form",function(){
 	var  btn=$(this) , form= btn.closest('form');
 	var id = form.find("[name='id']").val() ||  btn.data("id") ,urlDelete= btn.attr("href") || btn.data("url");

 	if( id && id.length > 0  ){


 		if(confirm("¿Esta seguro que desea eliminar registro?")){
 			loading= new Loading({zIndex:500,title:'Espere un momento'});
 			btn.prop("disabled",true);
 			$.getJSON(  urlDelete,{id:id}, function (data){
 				toastr.success(    data.message, data.title || 'Proceso satisfactorio.' );
 				btn.closest('.tmpl-item').remove();
 			}  ).always(function(){
 				btn.prop("disabled",false);
 				loading.out();
 			});
 		}
 	}
 	else{
 		btn.closest('.tmpl-item').remove();
 	}
 	

 	return false;




 })

});