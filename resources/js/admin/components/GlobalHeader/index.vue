<template>
  <div class="header">
    <router-link v-if="isMobile" class="logo" :to="{path:'/'}">
      <img src="~@img/favicon.png" alt="logo" width="32">
    </router-link>
    <span class="trigger" @click="toggle">
      <a-icon :type="collapsed ? 'menu-unfold' : 'menu-fold'" />
    </span>
    <right-content />
  </div>
</template>

<script>
import RightContent from './RightContent'
import { themeMixin } from '@/mixins'

export default {
  name: 'GlobalHeader',
  components: {
    RightContent
  },
  mixins: [
    themeMixin
  ],
  props: {
    collapsed: {
      type: Boolean,
      required: false,
      default: false
    }
    // collapse: {
    //   type: Function,
    //   required: true
    // }
  },
  methods: {
    toggle () {
      this.$emit('collapse', !this.collapsed)
      // this.collapse(!this.collapsed)
    }
  }
}
</script>

<style lang="less" scoped>
@import './index.less';
</style>
