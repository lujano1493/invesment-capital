$(document).ready(function(){



	  if($.jqplot){
	  	$.jqplot.config.enablePlugins = true;
	  }
	 


		$(".chart-investment").each(function (index,el){
			var chart = $(this),options= chart.data();
			var type = options.type;

			var plot1 = null;
			if(type == "bar" ){
				plot1=$.jqplot(chart.attr("id"), options.s1, {
		            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
		            animate: !$.jqplot.use_excanvas,
		            seriesDefaults:{
		                renderer:$.jqplot.BarRenderer,
		                pointLabels: { show: true },
		                 rendererOptions: {
						      barWidth: 50
						   } 
		            },
		            axes: {
		                xaxis: {
		                    renderer: $.jqplot.CategoryAxisRenderer,
		                    ticks: options.ticks
		                },
		                yaxis:{
		                	 tickOptions:{formatString: "$%'.2f"} 
		                }
		            },
		            highlighter: { show: false }
		        });

			}else if(type == "pie"){
				plot1=  $.jqplot(chart.attr("id"),   options.values /*[[['a',25],['b',14],['c',7]]]*/, {
			        gridPadding: {top:0, bottom:38, left:0, right:0},
			        seriesDefaults:{
			            renderer:$.jqplot.PieRenderer, 
			            trendline:{ show:false }, 
			            rendererOptions: { padding: 8, showDataLabels: true }
			        },
			        legend:{
			            show:true, 
			            placement: 'outside', 
			            rendererOptions: {
			                numberRows: 1
			            }, 
			            location:'s',
			            marginTop: '15px'
			        } ,
			             highlighter: { show: false }
			    });
			}
			else if (type == 'donut'){
				plot1= $.jqplot(chart.attr("id"), options.values, {
					title: options.title ||'',
				    seriesDefaults: {
				      // make this a donut chart.
				      renderer:$.jqplot.DonutRenderer,
				      rendererOptions:{
				        // Donut's can be cut into slices like pies.
				        sliceMargin: 3,
				        // Pies and donuts can start at any arbitrary angle.
				        startAngle: 0,
				        showDataLabels: true,
				        // By default, data labels show the percentage of the donut/pie.
				        // You can show the data 'value' or data 'label' instead.
				        dataLabels: 'value',
				        // "totalLabel=true" uses the centre of the donut for the total amount
				        totalLabel: true,
				        padding:2,
				        sliceMargin:2,
				        showDataLabels:true
				      }
				    },
				    legend: { show:true, location: 'e' },
			         highlighter: { show: false }
				  });
			}
		

		});

         
      
     
       
    });