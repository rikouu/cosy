/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'

require('./bootstrap');

import BackTop from './components/BackTop/index.vue'
import SideBar from './components/SideBar/index.vue'
import ArticleContent from './components/ArticleContent/index.vue'
import Modal from './components/Modal/index.vue'

const app = new Vue({
    directives: {
        // highlight: highlight
    },
    components: {
        BackTop: BackTop,
        Modal: Modal,
        SideBar: SideBar,
        ArticleContent: ArticleContent
    },
    data () {
        return {
            showSearchModal: false,
            showAuthorModal: false
        }
    },
    mounted() {
        // pangu.spacingPage()
    },
    methods: {
        footerClick() {
            console.log(1)
        }
    }
}).$mount('#app')

export default app