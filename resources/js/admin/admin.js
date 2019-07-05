import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'

import i18n from './locales'
import importDirective from '@/directive'

import bootstrap from './bootstrap'

Vue.config.productionTip = false

importDirective(Vue)

const app = new Vue({
  router,
  store,
  i18n,
  created () {
    bootstrap()
  },
  render: h => h(App)
}).$mount('#app')

export default app
