<template>
  <keep-alive>
    <a-locale-provider :locale="locale">
      <div id="app">
        <loading />
        <router-view v-if="isRouterAlive" />
      </div>
    </a-locale-provider>
  </keep-alive>
</template>

<script>
import zhCN from 'ant-design-vue/lib/locale-provider/zh_CN'
import { LocaleProvider } from 'ant-design-vue'
import Loading from '@/components/Loading'
import { deviceEnquire } from '@/utils/device'

export default {
  name: 'App',
  components: {
    ALocaleProvider: LocaleProvider,
    Loading
  },
  provide () {
    return {
      reload: this.reload
    }
  },
  data () {
    return {
      locale: zhCN,
      isRouterAlive: true
    }
  },
  mounted () {
    // setTimeout(() => {
    // document.getElementById('cosy-loader').style.display = 'none'
    // }, 200)
    deviceEnquire(screenType => {
      this.$store.dispatch('theme/SetScreen', screenType)
    })
  },
  methods: {
    reload () {
      this.isRouterAlive = false
      this.$nextTick(() => {
        this.isRouterAlive = true
      })
    }
  }
}
</script>
