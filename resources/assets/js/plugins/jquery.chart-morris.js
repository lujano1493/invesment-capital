$(document).ready(function (){
	
	 var doAction={
		"donut" :function (options){

			var _options = {
				data:[],
				barColors: ['#0b62a4', '#7a92a3', '#4da74d', '#afd8f8', '#edc240', '#cb4b4b', '#9440ed'],
        		resize: true

			};
			_options = $.extend( _options, options );
			//return Morris.Donut(options);



		},
		"bar": function (options){
				var _options = {
				data:[],
				hoverCallback: function (index, options, content, row) {
						  return "sin(" + row.x + ") = " + row.y;
				},
				xkey : '',
				ykeys: [],
				labels: [],
				hideHover: 'auto',
				barColors: ['#0b62a4', '#7a92a3', '#4da74d', '#afd8f8', '#edc240', '#cb4b4b', '#9440ed'],
        		resize: true

			};
			_options = $.extend( _options, options );
			//Morris.Bar(options);
		}

	};

	$(".chart-morris").each(function (index,el){
			var chart = $(this),options= chart.data();
			var type = options.type;
			options.element= chart.attr("id");
			var instance= doAction[type](options);
			chart.data( "instance" ,instance);
	});
});