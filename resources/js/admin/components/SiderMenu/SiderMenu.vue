<script>
import { Layout } from 'ant-design-vue'
import BaseMenu from './BaseMenu'
import { themeMixin } from '@/mixins'
import config from '@/config/base'
import logo from '@img/favicon.png'

const { Sider } = Layout

export default {
  name: 'SiderMenu',
  components: {
    BaseMenu,
    ALayoutSider: Layout.Sider
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
    },
    siderWidth: {
      type: Number,
      default: 256
    }
  },
  data () {
    return {
      title: config.name,
      firstMount: true
    }
  },
  methods: {
    onSelect (obj) {
      this.$emit('onSelect', obj)
    },
    onCollapse (collapsed) {

    },
    handleOpenChange () {

    }
  },
  mounted () {
    this.firstMount = false
  },
  render () {
    const { collapsed, isMobile, firstMount, siderWidth, theme, menus, fixSiderbar, navTheme, title } = this
    const siderClass = ['sider-menu-sider', {
      'fix-sider-bar': fixSiderbar,
      light: theme === 'light'
    }]

    return (
      <Sider
        collapsible
        trigger={null}
        collapsed={collapsed}
        breakpoint="lg"
        onCollapse={collapse => {
          if (firstMount || !isMobile) {
            this.onCollapse(collapse)
          }
        }}
        width={siderWidth}
        theme={theme}
        class={siderClass}
      >
        <div class="sider-menu-logo" id="logo">
          <a>
            <img src={logo} alt="logo"/>
            <h1>{title}</h1>
          </a>
        </div>
        <BaseMenu
          handleOpenChange={this.handleOpenChange}
          onOpenChange={this.handleOpenChange}
          style={{ padding: '16px 0', width: '100%' }}
          collapsed={collapsed}
          menu={menus}
          mode="inline"
          theme={navTheme}
          onSelect={this.onSelect}
        />
      </Sider>
    )
  }
}
</script>

<style lang="less" scoped>
@import "./index.less";
</style>
