import Vue from 'vue'
import axios from 'axios'
import $ from 'jquery'
import NProgress from 'nprogress'
import {Highlight} from "./utils/highlight";

require('theia-sticky-sidebar');

require('jquery-pjax');

declare global {
    interface Window {
        jQuery: JQueryStatic,
        $: JQueryStatic,
    }
}

interface CosyInterface {
    config: Object;
}

export function popup(type: string, html: any, maskStyle?: string, btnCallBack?: Function) {
    const mask = maskStyle ? 'style="' + maskStyle + '"' : '';

    let size = '';
    if (type === 'big') {
        size = 'cosy-tips-lg';
    } else if (type === 'no-padding') {
        size = 'cosy-tips-nopd';
    } else if (type === 'cover') {
        size = 'cosy-tips-cover cosy-tips-nopd';
    } else if (type === 'full') {
        size = 'cosy-tips-xl';
    } else if (type === 'small') {
        size = 'cosy-tips-sm';
    }

    const template = `
  <div class="cosy-tips ${size} cosy-tips-open">
  <div class="cosy-tips-overlay" ${mask}></div>
  <div class="cosy-tips-body">
  <div class="cosy-tips-content">${html}</div>
  <div class="btn-close-tips">
      <svg t="1553064665406" class="icon w-32" style="" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3368" xmlns:xlink="http://www.w3.org/1999/xlink" width="200" height="200">
      <defs><style type="text/css"></style></defs>
      <path d="M512 12C235.9 12 12 235.9 12 512s223.9 500 500 500 500-223.9 500-500S788.1 12 512 12z m166.3 609.7c15.6 15.6 15.6 40.9 0 56.6-7.8 7.8-18 11.7-28.3 11.7s-20.5-3.9-28.3-11.7L512 568.6 402.3 678.3c-7.8 7.8-18 11.7-28.3 11.7s-20.5-3.9-28.3-11.7c-15.6-15.6-15.6-40.9 0-56.6L455.4 512 345.7 402.3c-15.6-15.6-15.6-40.9 0-56.6 15.6-15.6 40.9-15.6 56.6 0L512 455.4l109.7-109.7c15.6-15.6 40.9-15.6 56.6 0 15.6 15.6 15.6 40.9 0 56.6L568.6 512l109.7 109.7z" p-id="3369"></path>
      </svg>
  </div>
  </div>
  </div>
  `;
    const popup = $(template);
    $('#app').append(popup);
    $('body').addClass('modal-open');
    // const lazyLoadInstance = (<any>window).lazyLoadInstance;
    // if (typeof lazyLoadInstance !== "undefined") {
    //     lazyLoadInstance.update();
    // }

    const close = function () {
        $('body').removeClass('modal-open');
        $(popup).removeClass('cosy-tips-open');
        $(popup).addClass('cosy-tips-close');
        setTimeout(function () {
            $(popup).removeClass('cosy-tips-close');
            setTimeout(function () {
                popup.remove();
            }, 200);
        }, 600);
    };

    $(popup).on('click', '.btn-close-tips, .cosy-tips-overlay', function (e) {
        e.preventDefault();
        close();
    });

    if (typeof btnCallBack === 'object') {
        Object.keys(btnCallBack).forEach(function (key) {
            $(popup).on('click touchstart', key, function (event) {
                let _ = (<any>btnCallBack)[key](event, close);
            });
        });
    }
    return popup;
}

class CosyConfig extends Object {
    public resources: Array<any>;

    constructor() {
        super();
        this.resources = [];
    }
}

export class Cosy implements CosyInterface {

    public bus: Vue;

    public config: CosyConfig;

    public bootingCallbacks: any[];

    public app: Vue | null = null;

    constructor(config: CosyConfig) {
        this.bus = new Vue();
        this.bootingCallbacks = [];
        this.config = config;
    }

    booting(callback: any) {
        this.bootingCallbacks.push(callback)
    }

    boot() {
        // this.bootingCallbacks.forEach(callback => callback(Vue, router, store));
        this.bootingCallbacks = [];
        this.loadPjax();
    }

    registerStoreModules() {
        this.config.resources.forEach((resource: any) => {
            // store.registerModule(resource.uriKey, resources)
        })
    }

    loaded() {
        $('.back-to-top').off('click').on('click', function (e) {
            e.preventDefault();
            $('html, body').stop().animate({scrollTop: 0}, 600);
        });

        $('.search-popup').off('click').on('click', function (e) {
            e.preventDefault();
            popup('full', $('#search-popup-wrap').html());
        });

        const sidebar = $(".sidebar");
        if (sidebar !== undefined) {
            (<any>sidebar).theiaStickySidebar({
                additionalMarginTop: 20,
                additionalMarginBottom: 100,
            });
        }

        const postContainer = $("#post");
        if (postContainer !== undefined) {
            Highlight.highlight();
        }
    }

    /**
     * Start the Cosy app by calling each of the tool's callbacks and then creating
     * the underlying Vue instance.
     */
    liftOff() {
        const that = this;
        this.boot();
        this.registerStoreModules();

        this.app = new Vue({
            el: '#app',
            components: {},
            mounted: function () {
                // this.$loading = this.$refs.loading;
                // NProgress.start();
                that.$on('error', (message: string) => {
                    // this.$toasted.show(message, {type: 'error'})
                });

                that.$on('token-expired', () => {
                    // this.$toasted.show(this.__('Sorry, your session has expired.'), {
                    //   action: {
                    //     onClick: () => location.reload(),
                    //     text: this.__('Reload'),
                    //   },
                    //   duration: null,
                    //   type: 'error',
                    // })
                })
            },
        })
    }

    /**
     * Return an axios instance configured to make requests to Cosy's API
     * and handle certain response codes.
     */
    request(options: object) {
        if (options !== undefined) {
            return axios(options)
        }

        return axios
    }

    /**
     * Register a listener on Cosy's built-in event bus
     */
    $on(event: string | string[], callback: Function) {
        this.bus.$on(event, callback);
    }

    /**
     * Register a one-time listener on the event bus
     */
    $once(event: string | string[], callback: Function) {
        this.bus.$once(event, callback);
    }

    /**
     * Unregister an listener on the event bus
     */
    $off(event: string | string[], callback: Function) {
        this.bus.$off(event, callback);
    }

    loadPjax() {
        const that = this;
        const container = $(document);
        (<any>container).pjax('a:not(a[target="_blank"])', '#app', {timeout: 1600, maxCacheLength: 500});
        container.on('pjax:start', function () {
            NProgress.start();
        });
        container.on('pjax:end', function () {
            NProgress.done();
            that.loaded();
        });
    }

    /**
     * Emit an event on the event bus
     */
    $emit(event: string, ...args: any[]) {
        this.bus.$emit(event, args);
    }

    /**
     * Determine if Cosy is missing the requested resource with the given uri key
     */
    missingResource(uriKey: string) {
        return true;
        // return _.find(this.config.resources, (r: any) => (r.uriKey === uriKey)) === undefined
    }

    thirdShare(type: string, url: string, title: string, img: string, desc: string) {
        console.log(url, type, title, img, desc);
    }
}

export const app = new Cosy((<any>window).config);

(function () {
    app.boot();
    app.loaded();
})();
