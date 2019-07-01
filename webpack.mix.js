const mix = require('laravel-mix')
const webpack = require('webpack')
const path = require('path')

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
    new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
  ],
  resolve: {
    extensions: ['.js', '.jsx', '.vue'],
    alias: {
      '@': path.resolve(__dirname, 'resources/js/admin')
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
    ]
  }
})

mix
  .options({
    extractVueStyle: true,
    autoprefixer: {}
  })
  .less('resources/less/app/app.less', 'public/css/app.css')
  .less('resources/less/admin/admin.less', 'public/css/admin.css')
  .js('resources/js/app/app.js', 'public/js/app.js')
  .js('resources/js/admin/admin.js', 'public/js/admin.js')
  .version()
  .disableSuccessNotifications()
