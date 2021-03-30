const path = require('path');
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

mix.js('resources/js/app.js', 'public/js').vue();
mix.js('resources/js/admin_app.js', 'public/js').vue();
mix.sass('resources/sass/app.scss', 'public/css');
mix.extract();

mix.webpackConfig({
    // For vue pug template
    module: {
        rules: [
            {
                test: /\.pug$/,
                oneOf: [
                    {
                        resourceQuery: /^\?vue/,
                        use: ['pug-plain-loader'],
                    },
                    {
                        use: ['raw-loader', 'pug-plain-loader'],
                    },
                ],
            },
        ],
    },
    output: {
        publicPath: '/',
        chunkFilename: 'js/[id].[chunkhash].js',
    },
    optimization: {
        providedExports: false,
        sideEffects: false,
        usedExports: false,
    },
    resolve: {
        alias: {
            '@admin': path.resolve(__dirname, 'resources/js/admin/'),
            '@pages': path.resolve(__dirname, 'resources/js/pages/'),
            '@store': path.resolve(__dirname, 'resources/js/store/'),
            '@mixins': path.resolve(__dirname, 'resources/js/mixins/'),
            '@components': path.resolve(__dirname, 'resources/js/components/'),
        },
    },
});

if (mix.inProduction()) {
    mix.version();
}
