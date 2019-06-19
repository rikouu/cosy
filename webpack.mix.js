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
    extensions: ['.ts', '.tsx'],
    alias: {
      '@': path.resolve(__dirname, 'resources/ts/admin'),
    }
  },
  module: {
    rules: [
      {
        test: /\.tsx?$/,
        loader: 'ts-loader',
        options: {
          appendTsSuffixTo: [/\.vue$/],
        },
        exclude: /node_modules/,
      },
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
  .less('resources/less/app/app.less', 'public/css/app.css')
  .less('resources/less/app/auth.less', 'public/css/auth.css')
  .less('resources/less/admin/admin.less', 'public/css/admin.css')
  .ts('resources/ts/admin/admin.ts', 'public/js/admin.js')
  .ts('resources/ts/app/app.ts', 'public/js/app.js')
  .version()
  .disableSuccessNotifications();

