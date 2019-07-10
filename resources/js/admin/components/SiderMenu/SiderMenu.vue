<script>
import { Layout } from 'ant-design-vue'
import BaseMenu from './BaseMenu'
import logo from '@img/favicon.png'

const { Sider } = Layout

export default {
  name: 'SiderMenu',
  components: {
    BaseMenu,
    ALayoutSider: Layout.Sider
  },
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
    },
    theme: {
      type: String,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    isMobile: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
      firstMount: true
    }
  },
  methods: {
    onSelect (obj) {
      this.$emit('onSelect', obj)
    },
    onCollapse (collapsed) {
      this.$emit('collapse', collapsed)
    },
    handleOpenChange () {

    }
  },
  mounted () {
    this.firstMount = false
  },
  render () {
    const { collapsed, isMobile, firstMount, siderWidth, theme, menus, fixSiderbar, title } = this
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
          // handleOpenChange={this.handleOpenChange}
          // onOpenChange={this.handleOpenChange}
          style={{ padding: '16px 0', width: '100%' }}
          collapsed={collapsed}
          menus={menus}
          mode="inline"
          theme={theme}
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
