(function( $ ){
	 $.fn.scrollElement = function (  callback,options){
 		if(!callback){
 			callback=function(){};
 		}

		if(!options ){
			options = { speed:700 ,offset:-50  }
		}
		 $('html, body').animate({
		    scrollTop: this.offset().top + options.offset
		  }, options.speed,'swing',callback);
		  this.focus();
		 return this;
	};
})(jQuery);