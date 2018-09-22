/*.Estilos y script para  Usuarios normale */

let mix = require('laravel-mix');

	mix.babel([
		'resources/assets/vendor/jquery.jqplot.1.0.9/jquery.jqplot.js',
		'resources/assets/vendor/jquery.jqplot.1.0.9/plugins/jqplot.donutRenderer.js',
		'resources/assets/vendor/jquery.jqplot.1.0.9/plugins/jqplot.dateAxisRenderer.js',
		'resources/assets/vendor/jquery.jqplot.1.0.9/plugins/jqplot.logAxisRenderer.js',
		'resources/assets/vendor/jquery.jqplot.1.0.9/plugins/jqplot.canvasTextRenderer.js',
		'resources/assets/vendor/jquery.jqplot.1.0.9/plugins/jqplot.canvasAxisTickRenderer.js',
		'resources/assets/vendor/jquery.jqplot.1.0.9/plugins/jqplot.highlighter.js',
		'resources/assets/vendor/jquery.jqplot.1.0.9/plugins/jqplot.barRenderer.js',
		'resources/assets/vendor/jquery.jqplot.1.0.9/plugins/jqplot.pieRenderer.js',
		'resources/assets/vendor/jquery.jqplot.1.0.9/plugins/jqplot.categoryAxisRenderer.js',
		'resources/assets/vendor/jquery.jqplot.1.0.9/plugins/jqplot.enhancedPieLegendRenderer.js',
		'resources/assets/vendor/jquery.jqplot.1.0.9/plugins/jqplot.pointLabels.js'
		], 'public/js/jqplot.js');