const mix = require('laravel-mix')
const { IgnorePlugin } = require('webpack')
const path = require('path')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const LiveReloadPlugin = require('webpack-livereload-plugin')

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
    new IgnorePlugin(/^\.\/locale$/, /moment$/),
    new CleanWebpackPlugin({
      cleanOnceBeforeBuildPatterns: [
        path.resolve(__dirname, 'public/{css,js}/*')
      ],
      verbose: true
    }),
    new LiveReloadPlugin()
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
    // extractVueStyle: true,
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
