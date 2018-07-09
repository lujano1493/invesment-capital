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
	.scripts([
			'node_modules/dot/doT.js',
			'node_modules/jquery.redirect/jquery.redirect.js',
			'node_modules/jquery-validation/dist/jquery.validate.js',
			'node_modules/jquery-validation-bootstrap-tooltip/jquery-validate.bootstrap-tooltip.js',
			'node_modules/toastr/toastr.js',
			'resources/assets/js/plugins/jquery.doT.js',
			'resources/assets/js/plugins/calc-rfc.js',
			'resources/assets/js/plugins/add-forms.js',
			'resources/assets/js/plugins/ajaxForm.js',
			'resources/assets/js/plugins/document-view.js',
			'resources/assets/js/plugins/modal-loading.js',
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
	'node_modules/startbootstrap-sb-admin-2/vendor/morrisjs/morris.css'

	] ,'public/css/app-invesment.css')
	.scripts(
		[
			'node_modules/startbootstrap-sb-admin/vendor/jquery/jquery.js',
			'node_modules/dot/doT.js',
			'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
			'node_modules/datatables.net/js/jquery.dataTables.js',
			'node_modules/startbootstrap-sb-admin-2/vendor/datatables-plugins/dataTables.bootstrap.js', // para obtener la version 3.7
			'node_modules/datatables-responsive/js/dataTables.responsive.js',
			'node_modules/particles.js/particles.js',
			'node_modules/startbootstrap-sb-admin-2/vendor/raphael/raphael.js',
			'node_modules/startbootstrap-sb-admin-2/vendor/metisMenu/metisMenu.js',
			'node_modules/morris.js06/morris.js',
			'node_modules/startbootstrap-sb-admin-2/js/sb-admin-2.js',
			'resources/assets/js/capital/main.js'

		], 'public/js/app-invesment.js');


mix.browserSync('invesment.capital');