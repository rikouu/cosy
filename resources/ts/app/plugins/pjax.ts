import $ from 'jquery'
import NProgress from 'nprogress'
import { app } from '../Cosy'

require('jquery-pjax');

(function () {
  const container = $(document);
  (<any>container).pjax('a:not(a[target="_blank"])', '#app', {timeout: 1600, maxCacheLength: 500});
  container.on('pjax:start', function () {
    NProgress.start();
  });
  container.on('pjax:end', function () {
    NProgress.done();
    console.log(1);
    app.loaded();
  });
})();
