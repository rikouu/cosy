import Cosy from './Cosy'

import jQuery from 'jquery'
import axios from 'axios'
import Popper from 'popper.js'

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  // (<any>window).Popper = Popper;
  // (<any>window).$ = (<any>window).jQuery = jQuery;
  (<any>window).Cosy = Cosy;
  // require('bootstrap');
} catch (e) {
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token: HTMLMetaElement | null = document.head.querySelector('meta[name="csrf-token"]');

if (document && document.head && document.head.querySelector('meta[name="csrf-token"]')) {
  token = document.head.querySelector('meta[name="csrf-token"]');
}

if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

(function () {
  const config = (<any>window).config;
  const cosy = new Cosy(config);
}.call(window));
