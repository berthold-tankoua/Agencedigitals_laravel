const mix = require('laravel-mix');

mix.setPublicPath('public');

// Fichiers CSS à compiler
mix.styles([
    'public/frontend/css/bootstrap.min.css',
    'public/frontend/css/swiper-bundle.min.css',
    'public/frontend/css/jquery.fancybox.min.css',
    'public/frontend/css/animate.css',
    'public/frontend/css/styles.css',
], 'public/css/app.css');

// Fichiers JS à compiler
mix.scripts([
    'public/frontend/js/jquery.min.js', // toujours en premier
    'public/frontend/js/bootstrap.min.js',
    'public/frontend/js/swiper-bundle.min.js',
    'public/frontend/js/carousel.js',
    'public/frontend/js/plugin.js',
    'public/frontend/js/jquery.nice-select.min.js',
    'public/frontend/js/rangle-slider.js',
    'public/frontend/js/shortcodes.js',
    'public/frontend/js/animation_heading.js',
    'public/frontend/js/jquery.fancybox.js',
    'public/frontend/js/main.js',
],  'public/js/app.js');

// Versionner en production pour éviter le cache navigateur
if (mix.inProduction()) {
    mix.version();
}