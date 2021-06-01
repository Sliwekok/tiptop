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

mix.setPublicPath('public_html/');

mix.js('resources/assets/js/app.js', 'public_html/js').sass('resources/assets/sass/app.scss', 'public_html/css').options({
    processCssUrls: false
});

mix.js('resources/assets/admin/js/admin.js', 'public_html/js').sass('resources/assets/admin/sass/admin.scss', 'public_html/css').options({
    processCssUrls: false
});

mix.copyDirectory('resources/assets/images', 'public_html/images');
mix.copyDirectory('resources/assets/fonts', 'public_html/fonts');