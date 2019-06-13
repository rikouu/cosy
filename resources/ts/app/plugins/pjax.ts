import $ from 'jquery'
import NProgress from 'nprogress'

require('jquery-pjax');

$(() => {
  const container = $(document);
  (<any>container).pjax('a:not(a[target="_blank"])', '#app', {timeout: 1600, maxCacheLength: 500});
  container.on('pjax:start', function () {
    NProgress.start();
  });
  container.on('pjax:complete', function () {
    NProgress.done();
  });
});
