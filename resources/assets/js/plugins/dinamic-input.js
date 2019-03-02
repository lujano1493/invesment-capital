$(document).ready(function (){
		$(document).on("change",".input-dinamic-select",function (){
				var select=$(this) , scope = select.data("scope") ,target = select.data("target"), targetLabel= select.data("target-label") ;
				context = scope ?  select.closest(scope) :  $(document);
				var val= select.val();
				var options = select.data("options");

				var option = options[val];

				option = option ? option : { type : "hidden" , label:"" , required:false};

				var targetInput = context.find(target );

				targetInput.prop("required" , option.required || false );
				targetInput.attr("type" , option.type);
				targetInput.val( option.default || ""  );
				
				var labelInput = context.find(targetLabel);
				labelInput.text( option.label);


				return false;

		});
});