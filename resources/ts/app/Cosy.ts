import Vue from 'vue'
import axios from 'axios'
import $ from 'jquery'
import NProgress from 'nprogress'

require('theia-sticky-sidebar');

require('jquery-pjax');

export class Cosy {

    public bus: Vue;

    public config: any;

    public bootingCallbacks: any[];

    public app: Vue | null = null;

    constructor(config: any) {
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
        $('#back-to-top').on('click', function () {
            $('html, body').stop().animate({scrollTop: 0}, 600);
        });

        const sidebar = $(".sidebar");

        if (sidebar !== undefined) {
            (<any>sidebar).theiaStickySidebar({
                additionalMarginTop: 20,
                additionalMarginBottom: 100,
            });
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
    request(options
                :
                object
    ) {
        if (options !== undefined) {
            return axios(options)
        }

        return axios
    }

    /**
     * Register a listener on Cosy's built-in event bus
     */
    $on(event
            :
            string | string[], callback
            :
            Function
    ) {
        this.bus.$on(event, callback);
    }

    /**
     * Register a one-time listener on the event bus
     */
    $once(event
              :
              string | string[], callback
              :
              Function
    ) {
        this.bus.$once(event, callback);
    }

    /**
     * Unregister an listener on the event bus
     */
    $off(event
             :
             string | string[], callback
             :
             Function
    ) {
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
    $emit(event
              :
              string,
          ...
              args: any[]
    ) {
        this.bus.$emit(event, args);
    }

    /**
     * Determine if Cosy is missing the requested resource with the given uri key
     */
    missingResource(uriKey
                        :
                        string
    ) {
        return true;
        // return _.find(this.config.resources, (r: any) => (r.uriKey === uriKey)) === undefined
    }

    thirdShare(type
                   :
                   string, url
                   :
                   string, title
                   :
                   string, img
                   :
                   string, desc
                   :
                   string
    ) {
        console.log(url, type, title, img, desc);
    }
}

export const app = new Cosy((<any>window).config);

(function () {
    app.boot();
    app.loaded();
})();
