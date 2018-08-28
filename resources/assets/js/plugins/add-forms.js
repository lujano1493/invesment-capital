$(document).ready(function (){

 $(document).on("click",".add-form",function (){
 	var btn= $(this),form=btn.closest('form') , target = btn.data('target')
 	, idTmpl=btn.data('id-tmpl') , type= btn.data('type') , clsTmpl = btn.data("cls-tmpl") ||  target.substring(1) +'-tmpl' , count =$(target).children().length  ,
 	titleHead= btn.data('title-head') || ('Nuevo Registro ' + count), idName = btn.data("id-name"), idValue= btn.attr("data-id-value"), addPosition= btn.data('add-position') ||'last';
 	var parentTarget = btn.data('parent-target');
 	var 	tmplHTML =  '';
 	if(!btn.data("id-count")){
 		btn.data("id-count", count);
 	}
 	var id =btn.data("id-count");
 	var data ={count:id};
 	btn.data("id-count",++id);
 	if( parentTarget ){
 		var parentTmpl = btn.closest(parentTarget);
 		data.parentCount=  parentTmpl.index()+1 ;
 	}
 	console.log(data);

 	tmplHTML=$.tmpl(idTmpl,data);



 	if( type  === 'accordion'){
 		tmplHTML =  $.tmpl('#tmpl-accordion-add', {targetContent: target+'_'+count ,titleHead: titleHead, target:target ,body : tmplHTML })
 	} else{
 		tmplHTML = '<div  class="'+clsTmpl +'">' +tmplHTML + '</div>';
 	}
 	tmplHTML = $(tmplHTML);

 	var idInput= tmplHTML.find( "[name='"+idName+"']" );
 	if( idInput.val() ==null  || idInput.val().length ==0 ){
 		idInput.val(  idValue );
 	}
 	
 	tmplHTML.addClass('tmpl-item');
 	 var form = tmplHTML.is("form") ? tmplHTML :tmplHTML.find("form");
 	// 	form.find("[id]").each(function (){
 	// 	if( $(this).hasClass("sub-tmpl") ){
 	// 		return true;
 	// 	}
 	// 	var  item=$(this),id = item.attr("id");
 	// 	item.attr("id", id+"_"+count );

 	// });

 	$(target)[   addPosition=='last'  ? 'append' :'prepend'   ]( tmplHTML);

 	$(tmplHTML).scrollElement(function (){
 		if(  type ==='accordion' ){
		 		$(target).find("[data-toggle='collapse']:"+ addPosition).click();
		 }
 	});
 	
 	btn.trigger("after.forms.add",[ target,tmplHTML]);
 	return false;
 });


 $(document).on("click",".btn-delete-form",function(){
 	var  btn=$(this) , form= btn.closest( btn.data("scope")|| 'form' );
 	var   nameId= btn.data("name-id")||"id" ,id = form.find("[name='"+nameId+"']").val() ||  btn.data("id") ,
 			urlDelete= btn.attr("href") || btn.data("url");


 	function removeTmpl(){
 		var tmpl =btn.closest('.tmpl-item');
 		var form =  tmpl.find("form");

 		var novalidate = form.attr("novalidate");

 		if(!!novalidate){
 			var validate = form.validate();
	 		form.find("input.error, select.error, textarea.error").each(function (index,el){
	 			$(el).tooltip('hide');
	 		});
	 		validate.resetForm();
 		}	
 		
 		tmpl.remove();

 	}


 	if( id && id.length > 0  ){


 		if(confirm("¿Esta seguro que desea eliminar registro?")){
 			var loading= new Loading({zIndex:500,title:'Espere un momento'});
 			btn.prop("disabled",true);
 			$.getJSON(  urlDelete,{id:id}, function (data){
 				toastr.success(    data.message, data.title || 'Proceso satisfactorio.' );
 				removeTmpl();
 			}  ).always(function(){
 				btn.prop("disabled",false);
 				loading.out();
 			});
 		}
 	}
 	else{
 		removeTmpl()
 	}
 	

 	return false;




 })

});