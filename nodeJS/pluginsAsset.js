
let mix = require('laravel-mix');


	mix.babel(
		[
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
			'node_modules/startbootstrap-sb-admin-2/js/sb-admin-2.js',
			'resources/assets/js/plugins/jquery.chart-morris.js',
			'resources/assets/js/plugins/jq.charts-investment.js',
			'resources/assets/js/plugins/config-app.js',
			'resources/assets/js/capital/main.js',
			'resources/assets/js/capital/cuestionario.js'

		], 'public/js/app-plugin.js')