var elixir = require('laravel-elixir');

elixir(function(mix) {
    // Sass
    mix.sass('app.scss');

    // JavaScript
    mix.browserify('app.js');

    // CSS Libraries
    mix.styles([
            '../../../node_modules/normalize.css/normalize.css'
        ], 'public/css/libs.css');

    // JavaScript Libraries
    mix.scripts([
            '../../../node_modules/jquery/dist/jquery.min.js',
            '../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.js'
        ], 'public/js/libs.js');
});
