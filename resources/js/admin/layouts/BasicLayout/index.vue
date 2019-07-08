<template>
  <div :class="screen">
    <a-layout>
      <sider-menu
        v-if="!(isTopMenu && !isMobile)"
        :menus="menus"
        :collapsed="collapsed"
        mode="inline"
        :collapsible="true"
        @collapse="handleMenuCollapse"
      />
      <a-layout :style="[{ minHeight: '100vh' }, layoutStyle]">
        <basic-header :menus="menus" :collapsed="collapsed" @collapse="handleMenuCollapse" />
        <a-layout-content class="basic-content" :style="contentStyle">
          <router-view />
        </a-layout-content>
        <basic-footer />
      </a-layout>
    </a-layout>
    <setting-drawer v-if="showSettingDrawer" />
  </div>
</template>

<script>
import { Layout } from 'ant-design-vue'
import SiderMenu from '@/components/SiderMenu'
import SettingDrawer from '@/components/SettingDrawer'
import Footer from './components/Footer'
import Header from './components/Header'
import { mapGetters } from 'vuex'
import { themeMixin } from '@/mixins'
const { Content } = Layout

export default {
  name: 'BasicLayout',
  mixins: [themeMixin],
  data () {
    return {
      menus: [],
      collapsed: false,
      showSettingDrawer: false
    }
  },
  computed: {
    ...mapGetters('theme', ['sidebar', 'screen']),
    ...mapGetters('permission', {
      mainMenu: 'addRouters'
    }),
    contentStyle () {
      if (this.fixedHeader) {
        return {}
      }
      return { paddingTop: 0 }
    },
    layoutStyle () {
      if (this.fixSidebar && this.layoutMode !== 'topmenu' && !this.isMobile) {
        return {
          paddingLeft: this.collapsed ? '80px' : '256px'
        }
      }
      return {}
    }
  },
  created () {
    this.menus = this.mainMenu.find(item => item.path === '/').children
    this.showSettingDrawer = window.config.debug || false
  },
  methods: {
    setSidebar (value) {
      this.$store.dispatch('theme/SetSidebar', value)
    },
    handleMenuCollapse (collapsed) {
      this.collapsed = !this.collapsed
      this.setSidebar(this.collapsed)
    },
    getPaddingLeft (hasLeftPadding, collapsed, siderWidth) {
      if (hasLeftPadding) {
        return collapsed ? 80 : siderWidth
      }
      return undefined
    }
  },
  render () {
    const { screen, showSettingDrawer, fixedHeader, isTopMenu, isMobile, menus, collapsed, hasLeftPadding, siderWidth = 256 } = this
    return (
      <div class={`${screen} basic-layout`}>
        <Layout>
          {!(isTopMenu && !isMobile) && (<SiderMenu
            menus={menus}
            collapsed={collapsed}
            mode="inline"
            collapsible={true}
            onCollapse={this.handleMenuCollapse}
          />)}
          <Layout style={{
            paddingLeft: this.getPaddingLeft(!!hasLeftPadding, collapsed, siderWidth),
            minHeight: '100vh'
          }}>
            <Header menus={menus} collapsed={collapsed} onCollapse={this.handleMenuCollapse} />
            <Content class="basic-layout-content" style={!fixedHeader ? { paddingTop: 0 } : {}}>
              <RouterView />
            </Content>
            <Footer />
          </Layout>
        </Layout>
        {showSettingDrawer && (<SettingDrawer />)}
      </div>
    )
  }
}
</script>

<style lang="less" scoped>
@import '~ant-design-vue/es/style/themes/default';

.basic-layout-content {
  margin: 24px;
  padding-top: @layout-header-height;
}
.basic-layout {
  .ant-layout {
    transition: all 0.2s;
  }
}
</style>
