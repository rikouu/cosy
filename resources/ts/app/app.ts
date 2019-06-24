/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'

require('./bootstrap');

import pangu from 'pangu'
import highlight from './directives/highlight'

import BackTop from './components/BackTop/index.vue'
import SideBar from './components/SideBar/index.vue'
import Modal from './components/Modal/index.vue'

const app = new Vue({
    directives: {
        highlight: highlight
    },
    components: {
        BackTop: BackTop,
        Modal: Modal,
        SideBar: SideBar
    },
    mounted() {
        pangu.spacingPage()
    }
}).$mount('#app')

export default app