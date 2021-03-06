$(document).ready(function (){
	toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "newestOnTop": false,
		  "progressBar": false,
		  "positionClass": "toast-top-center",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}


		doT.templateSettings = {
		  evaluate:    /\{%([\s\S]+?)%\}/g,
		  interpolate: /\{%=([\s\S]+?)%\}/g,
		  encode:      /\{%!([\s\S]+?)%\}/g,
		  use:         /\{%#([\s\S]+?)%\}/g,
		  define:      /\{%##\s*([\w\.$]+)\s*(\:|=)([\s\S]+?)#%\}/g,
		  conditional: /\{%\?(\?)?\s*([\s\S]*?)\s*%\}/g,
		  iterate:     /\{%~\s*(?:\}\}|([\s\S]+?)\s*\:\s*([\w$]+)\s*(?:\:\s*([\w$]+))?\s*%\})/g,
		  varname: 'it',
		  strip: true,
		  append: true,
		  selfcontained: false
		};


});