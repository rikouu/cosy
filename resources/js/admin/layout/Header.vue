<template>
  <a-layout-header v-if="visible">
    <global-header></global-header>
  </a-layout-header>
</template>

<script>
import { Layout } from 'ant-design-vue'
import GlobalHeader from '@/components/GlobalHeader'
export default {
  name: 'Header',
  components: {
    ALayoutHeader: Layout.Header,
    GlobalHeader: GlobalHeader
  },
  props: {
    visible: {
      type: Boolean,
      default: true
    }
  },
  computed: {
    headWidth () {
      const {
        isMobile,
        collapsed,
        fixedHeader,
        layout,
        siderWidth = 256
      } = this.props
      if (isMobile || !fixedHeader || layout === 'topmenu') {
        return '100%'
      }
      return collapsed ? 'calc(100% - 80px)' : `calc(100% - ${siderWidth}px)`
    }
  },
  render (createElement) {
    const width = this.headWidth
    const fixedHeader = true
    const visible = true
    return visible ? (
      <Header
        {...{
          style: { padding: 0, width, zIndex: 2 },
          class: fixedHeader ? 'fixedHeader' : ''
        }}
      >
        s
      </Header>
    ) : null
  }
}
</script>

<style lang="less" scoped>
.fixed-header {
  position: fixed;
  top: 0;
  right: 0;
  z-index: 9;
  width: 100%;
  transition: width 0.2s;
}
</style>
