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
del(['public/fonts/*']).then( 
	(paths) => {
   	console.log('\nEliminando archivos fonts :\n', paths.join('\n'));
	}
);
