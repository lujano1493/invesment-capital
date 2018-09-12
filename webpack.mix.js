let mix = require('laravel-mix');
const del = require('del');
/** Elominamos archivos temporale*/
del(['public/css/*']).then( 
	(paths) => {
   	console.log('\nElimando estilos :\n', paths.join('\n'));
	}
);

del(['public/js/*']).then( 
	(paths) => {
   	console.log('\nEliminando archivos javascripts :\n', paths.join('\n'));
	}
);


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/*.Estilos para administrativos */

mix.sass('resources/assets/sass/app-admin.scss', 'public/css/app-admin.css')
	.js('resources/assets/js/app-admin.js', 'public/js')
	.styles([
			'public/css/app-admin.css',
			'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css'], 'public/css/app-admin.css')
	.babel([
			'node_modules/dot/doT.js',
			'node_modules/jquery.redirect/jquery.redirect.js',
			'resources/assets/js/plugins/scroll-element.js',
			'resources/assets/js/plugins/serializeForm.js',
			'node_modules/jquery-validation/dist/jquery.validate.js',
			'node_modules/jquery-validation-bootstrap-tooltip/jquery-validate.bootstrap-tooltip.js',
			'node_modules/toastr/toastr.js',
			'resources/assets/js/plugins/jquery.doT.js',
			'resources/assets/js/plugins/calc-rfc.js',
			'resources/assets/js/plugins/calcular-balance.js',
			'resources/assets/js/plugins/add-forms.js',
			'resources/assets/js/plugins/ajaxForm.js',
			'resources/assets/js/plugins/document-view.js',
			'resources/assets/js/plugins/modal-loading.js',
			'resources/assets/js/plugins/config-app.js',
			'resources/assets/js/admin/main.js',

		],'public/js/main-admin.js');

/*.Estilos y script para  Usuarios normale */

mix.sass(
		'resources/assets/sass/app.scss', 'public/css/app-invesment.css')
	.styles([
	'public/css/app-invesment.css',
	'node_modules/startbootstrap-sb-admin-2/vendor/datatables-plugins/dataTables.bootstrap.css',
	'node_modules/startbootstrap-sb-admin-2/vendor/datatables-responsive/dataTables.responsive.css',
	'node_modules/startbootstrap-sb-admin-2/vendor/metisMenu/metisMenu.css',
	'node_modules/startbootstrap-sb-admin-2/dist/css/sb-admin-2.css',
	'resources/assets/vendor/jquery.jqplot.1.0.9/jquery.jqplot.css'

	] ,'public/css/app-invesment.css')
	.babel(
		[
			'node_modules/startbootstrap-sb-admin/vendor/jquery/jquery.js',
			'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
			'node_modules/datatables.net/js/jquery.dataTables.js',
			'node_modules/dot/doT.js',
			'node_modules/jquery.redirect/jquery.redirect.js',
			'node_modules/jquery-validation/dist/jquery.validate.js',
			'node_modules/jquery-validation-bootstrap-tooltip/jquery-validate.bootstrap-tooltip.js',
			'node_modules/toastr/toastr.js',
			'resources/assets/js/plugins/scroll-element.js',
			'resources/assets/js/plugins/serializeForm.js',
			'resources/assets/js/plugins/jquery.doT.js',
			'resources/assets/js/plugins/calc-rfc.js',
			'resources/assets/js/plugins/add-forms.js',
			'resources/assets/js/plugins/ajaxForm.js',
			'resources/assets/js/plugins/document-view.js',
			'resources/assets/js/plugins/modal-loading.js',
			'node_modules/startbootstrap-sb-admin-2/vendor/datatables-plugins/dataTables.bootstrap.js', // para obtener la version 3.7
			'node_modules/datatables-responsive/js/dataTables.responsive.js',
			'node_modules/particles.js/particles.js',
			'node_modules/startbootstrap-sb-admin-2/vendor/raphael/raphael.js',
			'node_modules/startbootstrap-sb-admin-2/vendor/metisMenu/metisMenu.js',
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
			'resources/assets/vendor/jquery.jqplot.1.0.9/plugins/jqplot.pointLabels.js',
			'node_modules/startbootstrap-sb-admin-2/js/sb-admin-2.js',
			'resources/assets/js/plugins/jquery.chart-morris.js',
			'resources/assets/js/plugins/jq.charts-investment.js',
			'resources/assets/js/plugins/config-app.js',
			'resources/assets/js/capital/main.js',
			'resources/assets/js/capital/cuestionario.js'

		], 'public/js/app-invesment.js');
