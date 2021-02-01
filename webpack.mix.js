const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

// mix.js('resources/js/carrera.js', 'public/js');


mix.js('resources/js/carreras.js', 'public/js');

mix.js('resources/js/profesores.js', 'public/js');

mix.js('resources/js/preguntas.js', 'public/js');