<script>
import { Layout } from 'ant-design-vue'
import SiderMenu from '@/components/SiderMenu'
import SettingDrawer from '@/components/SettingDrawer'
import Footer from './components/Footer'
import Header from './components/Header'
import { mapGetters } from 'vuex'
// import { themeMixin } from '@/mixins'
const { Content } = Layout

export default {
  name: 'BasicLayout',
  // mixins: [themeMixin],
  data () {
    return {
      menus: [],
      collapsed: true,
      showSettingDrawer: false
    }
  },
  computed: {
    ...mapGetters('theme', ['sidebar', 'screen', 'contentWidth',
      'layout', 'theme', 'isTopMenu', 'isMobile', 'fixSiderbar', 'fixedHeader' ]),
    ...mapGetters('permission', {
      mainMenu: 'addRouters'
    }),
    contentStyle () {
      if (this.fixedHeader) {
        return {}
      }
      return { paddingTop: 0 }
    },
    hasLeftPadding () {
      console.log(this)
      return this.fixSiderbar && !this.isTopMenu && !this.isMobile
    }
  },
  created () {
    this.menus = this.mainMenu.find(item => item.path === '/').children
    this.showSettingDrawer = true // window.config.debug || false
  },
  methods: {
    setSidebar (value) {
      this.$store.dispatch('theme/SetSidebar', value)
    },
    handleMenuCollapse (collapsed) {
      this.collapsed = !this.collapsed
      // this.setSidebar(this.collapsed)
    },
    getPaddingLeft (hasLeftPadding, collapsed, siderWidth) {
      if (hasLeftPadding) {
        return `${collapsed ? 80 : siderWidth}px`
      }
      return undefined
    }
  },
  render () {
    const { screen, showSettingDrawer,
      theme,
      fixedHeader = false, isTopMenu, isMobile, menus,
      collapsed, title = 'Cosy', hasLeftPadding, contentWidth, siderWidth = 256 } = this
    console.log(showSettingDrawer)
    return (
      <div class={`${screen} basic-layout`}>
        <Layout>
          {!(isTopMenu && !isMobile) && (
            <SiderMenu
              menus={menus}
              collapsed={collapsed}
              theme={theme}
              contentWidth={contentWidth}
              onCollapse={this.handleMenuCollapse}
              isMobile={isMobile}
              title={title}
            />)}
          <Layout style={{
            paddingLeft: this.getPaddingLeft(!!hasLeftPadding, collapsed, siderWidth),
            minHeight: '100vh'
          }}>
            <Header
              title={title}
              contentWidth={contentWidth}
              menus={menus}
              isTopMenu={isTopMenu}
              isMobile={isMobile}
              collapsed={collapsed}
              theme={theme}
              fixedHeader={fixedHeader}
              onCollapse={this.handleMenuCollapse}
            />
            <Content class="basic-layout-content" style={!fixedHeader ? { paddingTop: 0 } : {}}>
              <RouterView />
            </Content>
            <Footer />
          </Layout>
        </Layout>
        {
          showSettingDrawer && (<SettingDrawer />)
        }
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
