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
      '@': path.resolve(__dirname, 'resources/js/admin'),
      '@img': path.resolve(__dirname, 'resources/assets/images')
    }
  },
  module: {
    rules: [
      {
        test: /\.less$/,
        loader: 'less-loader',
        options: {
          javascriptEnabled: true
        }
      }
    ]
  }
})

mix.webpackConfig({
  output: {
    chunkFilename: `js/[name]${
      mix.inProduction() ? '.[chunkhash].js' : '.chunk.js'
    }`,
    publicPath: '/'
  }
})

mix
  .options({
    extractVueStyle: true,
    autoprefixer: {}
  })
  .less('resources/less/admin/admin.less', 'public/css/admin.css')
  .js('resources/js/admin/admin.js', 'public/js/admin.js')
  .less('resources/less/app/app.less', 'public/css/app.css')
  .js('resources/js/app/app.js', 'public/js/app.js')
  .version()
  .disableSuccessNotifications()

if (process.env.MIX_BROWSERSYNC || false) {
  mix.browserSync({
    proxy: process.env.MIX_BROWSERSYNC_PROXY || 'homestead.test',
    open: (process.env.MIX_BROWSERSYNC_OPEN === 'true')
  })
}
