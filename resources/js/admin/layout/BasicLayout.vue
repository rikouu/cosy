<template >
  <ALayout>
    <SiderMenu></SiderMenu>
    <router-view></router-view>
  </ALayout>
</template>

<script>
import { Layout } from 'ant-design-vue'
import SiderMenu from '@/components/SiderMenu'
export default {
  components: {
    ALayout: Layout,
    SiderMenu: SiderMenu
  }
}
</script>

<style lang="less" scoped>
@import "~ant-design-vue/es/style/themes/default.less";
</style>
