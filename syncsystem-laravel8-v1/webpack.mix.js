const mix = require('laravel-mix');
//require('dotenv').config();
// TODO: debug env not found.

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

//mix.js('resources/js/app.js', 'public/js')
 //mix.js('resources/' + env('CONFIG_DIRECTORY_JS') + '/app.js', env('CONFIG_DIRECTORY_BUILD_LARAVEL') + '/' + env('CONFIG_DIRECTORY_JS_SD'))
mix.js('resources/js/app.js', env('CONFIG_DIRECTORY_BUILD_LARAVEL') + '/' + env('CONFIG_DIRECTORY_JS_SD'))
 // Note: check https://github.com/laravel-mix/laravel-mix/issues/1096
 // Review: causing error with env()

 /*.postCss('resources/css/app.css', 'public/css', [
        //
    ])
    */
    /*
    .postCss('resources/app_styles/styles-backend.css', 'public/css', [
        //
    ])
    */
    //.sass('resources/app_styles/styles-backend.scss', 'public/css/styles-backend.bundle.css');
    .sass('resources/' + env('CONFIG_DIRECTORY_STYLES') + '/styles-backend.scss',  env('CONFIG_DIRECTORY_BUILD_LARAVEL') + '/' + env('CONFIG_DIRECTORY_STYLES_SD') + '/styles-backend.bundle.css');

    // typescript ref: https://sebastiandedeyne.com/typescript-with-laravel-mix/


