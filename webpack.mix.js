const mix = require('laravel-mix');
const webpack = require('webpack');
const liveReloadPlugin = require('webpack-livereload-plugin');
const path = require('path');

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


mix.webpackConfig({
  plugins: [
    new liveReloadPlugin(),
    new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/),
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
    }
  },
  module: {
    rules: [
      {
        test: /\.less$/,
        loader: require.resolve('less-loader'), // compiles Less to CSS
        options: {
          javascriptEnabled: true
        }
      }
    ],
  }
});

mix
  .options({
    extractVueStyle: true,
    autoprefixer: {},
  })
  .ts('resources/ts/app/app.ts', 'public/js/app.js')
  .less('resources/less/app/app.less', 'public/css/app.css')
  .less('resources/less/app/auth.less', 'public/css/auth.css')
  .js('resources/js/admin/admin.js', 'public/js/admin.js')
  .less('resources/less/admin/admin.less', 'public/css/admin.css')
  .version()
  .disableSuccessNotifications();

