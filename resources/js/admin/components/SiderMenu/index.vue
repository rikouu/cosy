<script>
import { Drawer } from 'ant-design-vue'
import SiderMenu from './SiderMenu'

export default {
  name: 'SiderMenuWrapper',
  components: {
    SiderMenu: SiderMenu,
    ADrawer: Drawer
  },
  props: {
    theme: {
      type: String,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    contentWidth: {
      type: String,
      required: true
    },
    collapsed: {
      type: Boolean,
      required: false,
      default: false
    },
    menus: {
      type: Array,
      required: true
    },
    isMobile: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    onSelect (obj) {
      this.$emit('menuSelect', obj)
    },
    collapse (collapsed) {
      this.$emit('collapse', collapsed)
    }
  },
  render () {
    const { isMobile, menus, collapsed, theme, title } = this
    return isMobile ? (
      <ADrawer
        visible={!collapsed}
        wrapStyle={{
          padding: 0,
          height: '100vh'
        }}
        zIndex={10}
        placement="left"
        onClose={() => this.collapse(true)}
      >
        <SiderMenu
          menus={menus}
          theme={theme}
          title={title}
          isMobile={isMobile}
          collapsed={isMobile ? false : collapsed}
          onCollapse={this.collapse}
        />
      </ADrawer>
    ) : (
      <SiderMenu
        menus={menus}
        theme={theme}
        title={title}
        isMobile={isMobile}
        collapsed={collapsed}
        onCollapse={this.collapse}
      />
    )
  }
}
</script>

<style lang="less">
.drawer .drawer-content {
  background: #001529;
}
.ant-drawer-left {
  .ant-drawer-body {
    padding: 0;
  }
}
</style>
