;(function ($) {
  window.NProgress = require('nprogress');
  require('jquery-pjax');

  $(document).ready(function () {
    $(document).pjax('a:not(a[target="_blank"])', '#app', {timeout: 1600, maxCacheLength: 500});
    $(document).on('pjax:start', function () {
      NProgress.start();
    });
    $(document).on('pjax:end', function () {
      NProgress.done();
    });
  });
})(jQuery);
