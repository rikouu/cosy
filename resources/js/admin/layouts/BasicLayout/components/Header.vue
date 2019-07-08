<script>
import { Layout } from 'ant-design-vue'
import TopNavHeader from '@/components/TopNavHeader'
import GlobalHeader from '@/components/GlobalHeader'
import { themeMixin } from '@/mixins'

const { Header } = Layout

export default {
  name: 'Header',
  mixins: [ themeMixin ],
  props: {
    collapsed: {
      type: Boolean,
      required: true
    },
    menus: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      oldScrollTop: 0,
      ticking: false,
      visible: true
    }
  },
  beforeDestroy () {
    document.removeEventListener('scroll', this.handScroll)
  },
  mounted () {
    document.addEventListener('scroll', this.handScroll, { passive: true })
  },
  methods: {
    getHeadWidth () {
      if (this.isMobile || !this.fixedHeader || this.isTopMenu) {
        return '100%'
      }
      return this.collapsed ? 'calc(100% - 80px)' : 'calc(100% - 256px)'
    },
    handScroll () {
      if (this.autoHideHeader) {
        var that = this
        const scrollTop = document.body.scrollTop + document.documentElement.scrollTop
        const visible = this.visible
        const numSlideFun = () => {
          if (that.oldScrollTop > scrollTop) {
            that.visible = true
          } else if (scrollTop > 300 && visible) {
            that.visible = false
          } else if (scrollTop < 300 && !visible) {
            that.visible = true
          }
          that.oldScrollTop = scrollTop
          requestAnimationFrame(numSlideFun)
        }
        numSlideFun()
      }
    },
    toggle () {
      this.collapse(!this.collapsed)
    },
    collapse (collapsed) {
      this.$emit('collapse', collapsed)
    },
    onMenuCollapse () {

    },
    renderContent () {
      const { isMobile, navTheme, collapsed, menus, isTopMenu, title } = this
      if (isTopMenu && !isMobile) {
        return (
          <TopNavHeader
            theme={navTheme}
            mode="horizontal"
            menus={menus}
            title={title}
            onCollapse={this.onMenuCollapse}
          />
        )
      } else {
        return (<GlobalHeader title={title} menus={menus} onCollapse={this.onMenuCollapse} collapsed={collapsed} />)
      }
    }
  },
  render () {
    const { visible, fixedHeader } = this
    const width = this.getHeadWidth()
    return visible ? (
      <Header
        style={{ padding: 0, width, zIndex: 2 }}
        class={fixedHeader ? 'fixed-header' : ''}
      >
        {this.renderContent()}
      </Header>
    ) : null
  }
}
</script>

<style lang="less" scoped>
@import './Header.less';
</style>
