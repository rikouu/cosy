<template>
  <div :class="{ 'top-nav-header': true, 'light': navTheme === 'light' }">
    <div ref="maim" :class="[ 'top-nav-header-main', { 'wide': wide }]">
      <div class="top-nav-header-left">
        <div id="logo" class="top-nav-header-logo">
          <router-link :to="{ path: '/' }">
            <img src="~@/assets/images/logo.svg" alt="logo" />
            <h1>{{ title }}</h1>
          </router-link>
        </div>
      </div>
      <div
        :style="{
         'maxWidth': maxWidth,
         'flex': 1,
         }"
        class="top-nav-header-menu"
      >
        <base-menu
          :collapsed="collapsed"
          :menu="menus"
          mode="horizontal"
          :theme="navTheme"
          @select="onSelect"
        />
      </div>
      <right-content />
    </div>
  </div>
</template>

<script >
import BaseMenu from '@/components/SiderMenu/BaseMenu'
import RightContent from '@/components/RightContent'
import { themeMixin } from '@/mixins'
import config from '@/config/base'

export default {
  name: 'TopNavHeader',
  components: {
    BaseMenu,
    RightContent
  },
  mixins: [themeMixin],
  props: {
    collapsed: {
      type: Boolean,
      required: false,
      default: false
    },
    menus: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      title: config.name,
      main: undefined
    }
  },
  computed: {
    wide () {
      return this.contentWidth === 'Fixed'
    },
    maxWidth () {
      const width =
        (this.contentWidth === 'Fixed' ? 1200 : window.innerWidth) -
        280 -
        120 -
        40
      return `${width}px`
    }
  },
  methods: {
    onSelect () {
      console.log(222)
    }
  }
}
</script>

<style lang="less" scoped>
@import "./index.less";
</style>
