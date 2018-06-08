let mix = require('laravel-mix');

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
	.styles(['public/css/app-admin.css','node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css'], 'public/css/app-admin.css');


/*.Estilos y script para  Usuarios normale */

mix.sass('resources/assets/sass/app.scss', 'public/css/app-invesment.css')
	.styles([
	'public/css/app-invesment.css',
	'node_modules/startbootstrap-sb-admin-2/vendor/metisMenu/metisMenu.css',
	'node_modules/startbootstrap-sb-admin-2/dist/css/sb-admin-2.css',
	'node_modules/startbootstrap-sb-admin-2/vendor/morrisjs/morris.css',

	] ,'public/css/app-invesment.css')
	.scripts(
		[
			'node_modules/startbootstrap-sb-admin/vendor/jquery/jquery.js',
			'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
			'node_modules/startbootstrap-sb-admin-2/vendor/raphael/raphael.js',
			'node_modules/startbootstrap-sb-admin-2/vendor/metisMenu/metisMenu.js',
			'node_modules/startbootstrap-sb-admin-2/vendor/morrisjs/morris.js',
			'node_modules/startbootstrap-sb-admin-2/js/sb-admin-2.js'

		], 'public/js/app-invesment.js');



mix.browserSync('invesment.capital');