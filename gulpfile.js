var elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.webpack('main.js');
    mix.webpack('app.js');
    mix.webpack('bootstrap.js');
    mix.webpack('retina-1.1.0.js');
    mix.webpack('jquery.hoverdir.js');
    mix.webpack('jquery.hoverex.min.js');
    mix.webpack('jquery.isotope.min.js');
    mix.webpack('bootstrap-datepicker.min.js');
    mix.webpack('utils.js');
    mix.sass('resources/assets/sass/home.scss', 'public/css');
    mix.sass('resources/assets/sass/app.scss', 'public/css');
    mix.sass('resources/assets/sass/bootstrap-datepicker3.min.scss', 'public/css');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/', 'public/fonts/bootstrap');
});