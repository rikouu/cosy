<template>
  <a-locale-provider :locale="locale">
    <div id="app">
      <router-view v-if="isRouterAlive"/>
    </div>
  </a-locale-provider>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import zhCN from 'ant-design-vue/lib/locale-provider/zh_CN'
import { LocaleProvider } from 'ant-design-vue'
// import { deviceEnquire } from '@/utils/device'

@Component({
  components: {
    ALocaleProvider: LocaleProvider
  }
})
export default class App extends Vue {
  protected isRouterAlive = true;

  protected locale: any = zhCN;

  public mounted () {
    // deviceEnquire(screenType => {
    //   this.$store.dispatch('theme/SetScreen', screenType)
    // })
  }

  protected reload () {
    this.isRouterAlive = false
    this.$nextTick(() => {
      this.isRouterAlive = true
    })
  }
}
</script>
