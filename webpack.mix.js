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

mix.sass('resources/assets/sass/public.scss', 'public/css')
    .sass('resources/assets/sass/student.scss', 'public/css')
    .sass('resources/assets/sass/admin.scss', 'public/css');

mix.js('resources/assets/js/public.js', 'public/js')
    .js('resources/assets/js/student.js', 'public/js')
    .js('resources/assets/js/admin.js', 'public/js');

mix.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'resources/assets/semantic/semantic.min.js',
    'node_modules/chart.js/dist/Chart.min.js',
    'node_modules/randomcolor/randomColor.js',
    'node_modules/persianjs/persian.js',
    'node_modules/persian-date/dist/persian-date.min.js',
    'node_modules/persian-datepicker/dist/js/persian-datepicker.min.js',
    'node_modules/jquery-timepicker/jquery.timepicker.js'
], 'public/js/vendor.js');

mix.styles([
    'resources/assets/css/IRANSans.css',
    'resources/assets/semantic/semantic.rtl.min.css',
    'node_modules/persian-datepicker/dist/css/persian-datepicker.css',
    'node_modules/jquery-timepicker/jquery.timepicker.css'
], 'public/css/vendor.css');

mix.copyDirectory('resources/assets/semantic/themes/default', 'public/css/themes/default');
mix.copyDirectory('resources/assets/fonts', 'public/fonts');
