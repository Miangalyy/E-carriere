const mix = require('laravel-mix');

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
 const path = require("path");

 // Rezolve Ziggy
 mix.alias({
     ziggy: path.resolve("vendor/tightenco/ziggy/dist/vue"),
 });

 mix.js('resources/js/app.js', 'public/js').vue()
 .postCss('resources/css/app.css', 'public/css', [
     //require('postcss-import')
 ])
 .disableNotifications()
 .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
 mix.version();
}