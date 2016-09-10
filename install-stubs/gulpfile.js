const elixir = require('laravel-elixir');
require('laravel-elixir-vue');
require('hexavel-elixir-config');

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
    mix.less('app.less')
        .browserify('app.js', null, null, { paths: 'vendor/laravel/spark/resources/assets/js' })
        .copy('node_modules/sweetalert/dist/sweetalert.min.js', 'public/js/sweetalert.min.js')
        .copy('node_modules/sweetalert/dist/sweetalert.css', 'public/css/sweetalert.css');
});

/*
 |--------------------------------------------------------------------------
 | Elixir Test Management
 |--------------------------------------------------------------------------
 |
 | Beyond just assets you can use Elixir to monitor for code changes which
 | will check tests and provide notifications for when your application has
 | breaking changes.
 |
 */

elixir(function(mix) {
    mix.phpSpec();
});

elixir(function(mix) {
    mix.behat();
});