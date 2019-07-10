<script>
import { Layout } from 'ant-design-vue'
import TopNavHeader from '@/components/TopNavHeader'
import GlobalHeader from '@/components/GlobalHeader'

const { Header } = Layout

export default {
  name: 'Header',
  props: {
    collapsed: {
      type: Boolean,
      required: true
    },
    menus: {
      type: Array,
      required: true
    },
    contentWidth: {
      type: String,
      required: true
    },
    isTopMenu: {
      type: Boolean,
      required: true
    },
    isMobile: {
      type: Boolean,
      required: true
    },
    title: {
      type: String,
      default: ''
    },
    fixedHeader: {
      type: Boolean,
      required: true
    },
    theme: {
      type: String,
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
        console.log(100)
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
    onMenuCollapse (collapsed) {
      this.$emit('collapse', collapsed)
    },
    renderContent () {
      const { isMobile, theme, collapsed, menus, isTopMenu, title, contentWidth } = this
      if (isTopMenu && !isMobile) {
        return (
          <TopNavHeader
            theme={theme}
            mode="horizontal"
            menus={menus}
            title={title}
            isMobile={isMobile}
            onCollapse={this.onMenuCollapse}
            contentWidth={contentWidth}
          />
        )
      } else {
        return (<GlobalHeader theme={theme} isMobile={isMobile} menus={menus} onCollapse={this.onMenuCollapse} collapsed={collapsed} />)
      }
    }
  },
  render () {
    const { visible, fixedHeader } = this
    const width = this.getHeadWidth()
    return visible ? (
      <Header
        style={{ padding: 0, width: width, zIndex: 2 }}
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
