
const env  = require('minimist')(process.argv.slice(2));

const argv = require('yargs').argv;

let mix = require('laravel-mix');


 if(mix.inProduction()){
 	mix.disableNotifications();
 }








	
require('./nodeJS/clearAsset');
require('./nodeJS/adminAsset');
require('./nodeJS/appAsset');
require('./nodeJS/pluginsAsset');
require('./nodeJS/jqplotAsset');




