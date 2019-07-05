/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
import axios from 'axios'

// Components
import BackTop from './components/BackTop/index.vue'
import ArticleContent from './components/ArticleContent/index.vue'
import Modal from './components/Modal/index.vue'
import AjaxLoader from './components/AjaxLoader/index.vue'

// Directives
import like from './directives/Like'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
let token = document.head.querySelector('meta[name="csrf-token"]')

if (document && document.head && document.head.querySelector('meta[name="csrf-token"]')) {
  token = document.head.querySelector('meta[name="csrf-token"]')
}

if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}

const app = new Vue({
  directives: {
    like: like
    // sticky: sticky,
  },
  components: {
    BackTop: BackTop,
    Modal: Modal,
    ArticleContent: ArticleContent,
    AjaxLoader: AjaxLoader
  },
  data () {
    return {
      showSearchModal: false,
      showAuthorModal: false
    }
  },
  created () {
    addEventListener('DOMContentLoaded', function () {
      if (window.pageYOffset > 0) {
        setTimeout(() => {
          window.scrollTo(0, 0)
          document.body.scrollTop = 0
        }, 100)
      }
    }, false)
  },
  methods: {

  }
}).$mount('#app')

export default app
