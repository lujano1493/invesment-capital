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
			'resources/assets/js/plugins/dinamic-input.js',
			'resources/assets/js/plugins/config-app.js',
			'resources/assets/js/admin/main.js',

		],'public/js/plugin-admin.js');