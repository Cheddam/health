var elixir = require('laravel-elixir');

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

elixir.config.production = true;

elixir(function(mix) {
    mix.browserify('bundles/front/fill.js', './public/js/front/fill.js')
       .browserify('bundles/front/leaderboards.js', './public/js/front/leaderboards.js')
       .browserify('bundles/back/goals.js', './public/js/back/goals.js');
});
