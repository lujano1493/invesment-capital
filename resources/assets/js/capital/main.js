

$(document).ready(function (){
	


	/**  Modificacion de perfil  */
	

	$(document).on("click","[data-confirm-change]",function (){
		var btn= $(this),modalConfirm=  $( btn.data("confirm-change") || "#modal-confirm" ) ,modalChange= btn.closest(".modal"),
			 form = modalChange.find("form");

		var action = form.attr("action"), method=form.attr("method");
		var data = {};
		form.find("input,select,textarea").each(function (index,el){
			var field =$(this);
			data[ field.attr("name") ] = field.val();
		});

		modalConfirm.data( "change-do" ,{
			modalChange: modalChange,
			action: action,
			data:data,
			method: method
			} );
		modalChange.modal("hide");
		modalConfirm.modal("show");

	});

	$(document).on("click",".btn-confirm-change",function (){
			var btn= $(this),modalConfirm= btn.closest(".modal");

			var psw= modalConfirm.find("[name='password']");
			var infoForm= modalConfirm.data("change-do");
			var action =  infoForm.action;
			var data= infoForm.data;
			var method =infoForm.method;
			var modalChange = infoForm.modalChange;
			var form = modalChange.find("form");
			data.password = psw.val();

			$.ajax({
				  url:  action ,
				  data: data,
				  method:method,
				  beforeSend: function( xhr ) {
				   	btn.prop("disabled",true);
				   	if(form.find(".row.alert-group").length === 0){
				  			form.prepend("<div class=\"row alert-group\"> </div>" )
				  	}
				  	form.find(".row.alert-group").empty();
				  	form.find(".message-error").remove();
				  	form.find(".form-group").removeClass("has-error");

				  },
				  dataType:"json"
				})
				  .done(function( data ) {	
				  		
				  	var alertGroup = form.find(".row.alert-group");

				  	var alertClass=  data.status ==="ok"?  "alert-success": "alert-danger";
				  	alertGroup.html(
				  		"<div class=\"alert "+alertClass+"\"> "+
				  			data.message+ 
				  			"<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">"+
				  			" <span aria-hidden=\"true\">&times;</span>"+
				  			"</button>"+
				  		"</div>" );
				  	if(data.validationFields){
				  		for( var name in data.validationFields){
				  			var validations = data.validationFields[name];
				  			var input =form.find("[name=\""+name+"\"]");
				  			var formGroup= input.closest("div.form-group");
				  			formGroup.addClass("has-error");
				  			$(validations).each(function(index,el){
				  				formGroup.append("<label class=\"control-label message-error\"> "+el +"</label>" )
				  			});
				  		}
				  	}

				  	//change field
				  	if( data.status ==="ok"){
				  		form.each(function (index,el){
				  			this.reset();
				  		});
				  	}
				  	if( data.results){
				  		for( var name in data.results ){
				  			$("#" +name).val( data.results[name] );
				  		}
				  	}


				  }).always(function (results,textStatus,errorThrown){
				  	btn.prop("disabled",false);
				  	modalConfirm.modal("hide");
				  	modalChange.modal("show");
				  });

	});


/*funciones para el cambio de correo,contraseña y nickname*/

$("#confirm-password").on("show.bs.modal",function (){
	var modal=$(this);
	modal.find("[name='password']").val("");
});

$("#modal-cambio-password").on("show.bs.modal",function (){
	var modal=$(this);
	modal.find("form").each(function (el,index){
		this.reset();
	});
});

if($("#container-home").length > 0){
particlesJS.load('container-home', 'assets/particlesjs-config.json', function() {
	

	});
}




$(document).on("keypress", "#password", function(event) {
    if (event.keyCode == 13) {
        event.preventDefault();
    }
});


});