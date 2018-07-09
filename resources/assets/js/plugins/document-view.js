$(function() {


	$(document).on("click",".download-document",function (){
		var btn= $(this), url= btn.data("url");

		$.redirect(url, { },"GET" );

		return false;
	});




	$(document).on("click",".view-document",function(){
		var btn= $(this), url= btn.data("url"),type = btn.data("type") , modal= $("#view-doc"), title= btn.data("title");
		var content=null;
		if( type.indexOf("image") >-1 ){
			content= modal.find(".content").html( "<img class='modal-view-doc-content img-fluid' >" ).find("img");
		}
		else if (type.indexOf("pdf")>-1){
			var width=	$( document ).width() ;
			var height= $(document).height()*.6;
			 content= modal.find(".content").html( "<iframe class='modal-view-iframe' width='"+width+"'  height='"+height+"' > </iframe> " ).find("iframe");
		}
		content.attr("src",url);
		modal.find(".caption").text(title);
		modal.css("display","block");
		return false;


	});

	$(document).on("click",".modal-view-doc .close",function(){
		$(this).closest(".modal-view-doc").css("display","none");
	});


});