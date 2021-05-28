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

/*arquivos css*/
mix.copy('resources/css/style.css', 'public/css')
    .copy('resources/images/logo.png', 'public/images')
    .copy('resources/images/pac-man.svg', 'public/images')
    .copy('resources/images/loader.svg', 'public/images')
    .copy('resources/images/gta4.ico', 'public/images')
    .copy('resources/images/ets2.png', 'public/images')
    .copy('resources/images/gta5.png', 'public/images')
    .copy('resources/images/gtasa.png', 'public/images')
    .copy('resources/images/model-3d.png', 'public/images')
    .copy('resources/images/user.png', 'public/images')
    .copy('resources/images/background-image.png', 'public/images')
    .copy('resources/css/style-menu.css', 'public/css')
    .copy('resources/css/style.css', 'public/css')
    .copy('resources/css/skin-modes.css', 'public/css')
    .copy('resources/css/dark-style.css', 'public/css')
    .copy('resources/css/icons.css', 'public/css');

/*plugins css*/
mix.copy('resources/plugins/sidemenu/sidemenu.css', 'public/plugins/sidemenu/sidemenu.css')
    .copy('resources/plugins/bootstrap-daterangepicker/daterangepicker.css', 'public/plugins/bootstrap-daterangepicker/daterangepicker.css')
    .copy('resources/plugins/sidebar/sidebar.css', 'public/plugins/sidebar/sidebar.css')
    .copy('resources/plugins/p-scrollbar/p-scrollbar.css', 'public/plugins/p-scrollbar/p-scrollbar.css')
    .copy('resources/plugins/sidemenu/sidemenu.css', 'public/plugins/sidemenu/sidemenu.css')
    .copy('resources/plugins/bootstrap/css/bootstrap.min.css', 'public/plugins/bootstrap/css/bootstrap.min.css');

/*Arquivos js*/
mix.copy('resources/js/jquery-3.4.1.min.js', 'public/js')
    .copy('resources/js/jquery.sparkline.min.js', 'public/js')
    .copy('resources/js/circle-progress.min.js', 'public/js')
    .copy('resources/js/custom.js', 'public/js')
    .copy('resources/iconfonts/', 'public/iconfonts');

/*Plugins js*/
mix.copy('resources/plugins/bootstrap/js/popper.min.js', 'public/plugins/bootstrap/js/popper.min.js')
    .copy('resources/plugins/bootstrap/js/bootstrap.min.js', 'public/plugins/bootstrap/js/bootstrap.min.js')
    .copy('resources/plugins/rating/jquery.rating-stars.js', 'public/plugins/rating/jquery.rating-stars.js')
    .copy('resources/plugins/moment/moment.min.js', 'public/plugins/moment/moment.min.js')
    .copy('resources/plugins/bootstrap-daterangepicker/daterangepicker.js', 'public/plugins/bootstrap-daterangepicker/daterangepicker.js')
    .copy('resources/plugins/sidemenu/sidemenu.js', 'public/plugins/sidemenu/sidemenu.js')
    .copy('resources/plugins/counters/jquery.missofis-countdown.js', 'public/plugins/counters/jquery.missofis-countdown.js')
    .copy('resources/plugins/p-scrollbar/p-scrollbar.js', 'public/plugins/p-scrollbar/p-scrollbar.js')
    .copy('resources/plugins/p-scrollbar/p-scrollbar-leftmenu.js', 'public/plugins/p-scrollbar/p-scrollbar-leftmenu.js')
    .copy('resources/plugins/sidebar/sidebar.js', 'public/plugins/sidebar/sidebar.js')
    .copy('resources/plugins/counters/counter.js', 'public/plugins/counters/counter.js')
