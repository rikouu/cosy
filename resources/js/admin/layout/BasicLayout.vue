<template >
  <a-layout>
    <SiderMenu />
    <a-layout :style="{ minHeight: '100vh' }">
      <base-header ></base-header>
      <!-- <router-view></router-view> -->
    </a-layout>
  </a-layout>
</template>

<script>
import { Layout } from 'ant-design-vue'
import BaseHeader from './Header.vue'
import SiderMenu from '@/components/SiderMenu'
export default {
  components: {
    ALayout: Layout,
    SiderMenu: SiderMenu,
    BaseHeader: BaseHeader
  }
}
</script>

<style lang="less" scoped>
@import "~ant-design-vue/es/style/themes/default.less";
</style>
