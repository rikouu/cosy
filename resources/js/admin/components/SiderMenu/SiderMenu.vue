<template>
  <a-layout-sider collapsible :trigger="null" breakpoint="lg" :width="siderWidth">
    <div class="logo" id="logo">
      <a>
        <img :src="logo" alt="logo"/>
        <h1>{{ title }}</h1>
      </a>
    </div>
  </a-layout-sider>
</template>

<script>
import logo from '@/assets/images/logo.png'
import { Layout } from 'ant-design-vue'

export default {
  name: 'SiderMenu',
  props: {
    title: {
      type: String,
      default: 'Cosy'
    },
    siderWidth: {
      type: Number,
      default: 256
    }
  },
  data () {
    return {
      logo: logo
    }
  },
  components: {
    ALayoutSider: Layout.Sider
  }
}
</script>

<style lang="less" scoped>
@import "~ant-design-vue/es/style/themes/default";

@nav-header-height: @layout-header-height;

.logo {
  position: relative;
  height: @nav-header-height;
  padding-left: (@menu-collapsed-width - 32px) / 2;
  overflow: hidden;
  line-height: @nav-header-height;
  background: @layout-sider-background;
  transition: all 0.3s;
  img {
    display: inline-block;
    height: 32px;
    vertical-align: middle;
  }
  h1 {
    display: inline-block;
    margin: 0 0 0 12px;
    color: white;
    font-weight: 600;
    font-size: 20px;
    font-family: Avenir, "Helvetica Neue", Arial, Helvetica, sans-serif;
    vertical-align: middle;
  }
}
</style>
