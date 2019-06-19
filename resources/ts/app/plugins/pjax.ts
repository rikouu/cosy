import $ from 'jquery'
import NProgress from 'nprogress'
import { app } from '../Cosy'
import 'jquery-pjax'
// require('jquery-pjax');

declare global {
  interface JQuery<TElement = HTMLElement> {
    pjax(target: string, container?: string, config?: Object): this;
  }
}

(function () {
  const container: JQuery<Document> = $(document);
  container.pjax('a:not(a[target="_blank"])', '#app', { timeout: 1600, maxCacheLength: 500 });
  container.on('pjax:start', function () {
    NProgress.start();
  });
  container.on('pjax:end', function () {
    NProgress.done();
    console.log(1);
    app.loaded();
  });
})();
