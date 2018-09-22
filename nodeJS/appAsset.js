
let mix = require('laravel-mix');


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
	.babel([
			'node_modules/startbootstrap-sb-admin/vendor/jquery/jquery.js',
			'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
			'node_modules/datatables.net/js/jquery.dataTables.js',
			'node_modules/dot/doT.js',
			'node_modules/jquery.redirect/jquery.redirect.js',
			'node_modules/jquery-validation/dist/jquery.validate.js',
			'node_modules/jquery-validation-bootstrap-tooltip/jquery-validate.bootstrap-tooltip.js',
			'node_modules/toastr/toastr.js'
		], 'public/js/app.js')