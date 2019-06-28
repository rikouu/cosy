/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue, { ComponentOptions } from 'vue'

require('./bootstrap');

// Components
import BackTop from './components/BackTop/index.vue'
import SideBar from './components/SideBar/index.vue'
import ArticleContent from './components/ArticleContent/index.vue'
import Modal from './components/Modal/index.vue'
import AjaxLoader from './components/AjaxLoader/index.vue'

// Directives
import like from './directives/Like'

const app = new Vue({
    directives: {
        like: like,
        // sticky: sticky,
    },
    components: {
        BackTop: BackTop,
        Modal: Modal,
        SideBar: SideBar,
        ArticleContent: ArticleContent,
        AjaxLoader: AjaxLoader
    },
    data() {
        return {
            showSearchModal: false,
            showAuthorModal: false,
        }
    },
    methods: {

    }
}).$mount('#app')

export default app
