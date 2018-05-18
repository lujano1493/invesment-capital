var elixir = require('laravel-elixir');
require('laravel-elixir-remove');

var base_src  = 'resources/assets';
var base_dest = 'public/assets';


elixir(function(mix) {



    // Cleanup Destination
    mix.remove(base_dest);


    mix.webpack('resources/assets/js/app.js', 'public/js/base.js');

    mix.sass('resources/assets/sass/app.scss', 'public/css/base.css');

    mix.styles(['node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css'], 'public/css/main.css')

    // Compile SASS
   // mix.sass('main.scss', base_src + '/css/main.css');



    //mix.remove(  'public/css/main.css');
   // mix.remove('public/css/base.css')
});