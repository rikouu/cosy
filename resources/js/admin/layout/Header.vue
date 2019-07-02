<template>
  <a-layout-header
    v-if="visible"
    :class="{ 'fixedHeader': fixedHeader  }"
    :style="{ padding: 0, width: getHeadWidth(), zIndex: 2 }"
  >
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
    },
    collapsed: {
      type: Boolean,
      default: true
    },
    fixedHeader: {
      type: Boolean,
      default: true
    },
    layout: {
      type: String,
      default: function () {
        return 'topmenu'
      }
    },
    siderWidth: {
      type: Number,
      default: 256
    }
  },
  data () {
    return {
      isMobile: false

    }
  },
  computed: {},
  methods: {
    getHeadWidth () {
      if (this.isMobile || !this.fixedHeader || this.layout === 'topmenu') {
        return '100%'
      }
      return this.collapsed ? 'calc(100% - 80px)' : `calc(100% - ${this.siderWidth}px)`
    }
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
