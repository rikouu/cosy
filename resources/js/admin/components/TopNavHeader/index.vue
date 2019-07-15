<script >
import BaseMenu from '@/components/SiderMenu/BaseMenu'
import RightContent from '@/components/RightContent'
import logo from '@img/favicon.png'

export default {
  name: 'TopNavHeader',
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
    title: {
      type: String,
      required: true
    },
    mode: {
      type: String,
      required: true
    },
    theme: {
      type: String,
      required: true
    },
    contentWidth: {
      type: String,
      required: true
    },
    isMobile: {
      type: Boolean,
      required: true
    }
  },
  data () {
    return {
      main: undefined
    }
  },
  methods: {
    onSelect () {
      console.log(222)
    },
    getMaxWidth () {
      const innerWidth = window.innerWidth || 0
      const width = (this.contentWidth === 'Fixed' && innerWidth > 1200 ? 1200 : innerWidth) - 280 - 200
      return `${width}px`
    }
  },
  render () {
    const { theme, menus, collapsed, title, contentWidth, isMobile } = this
    const maxWidth = this.getMaxWidth()
    return (
      <div class={`top-nav-header ${theme === 'light' ? 'light' : ''}` }>
        <div ref="maim" class={`top-nav-header-main ${contentWidth === 'Fixed' ? 'wide' : ''}` }>
          <div class="top-nav-header-left">
            <div id="logo" class="top-nav-header-logo">
              <RouterLink to={{ path: '/' }}>
                <img src={logo} alt="logo" />
                <h1>{ title }</h1>
              </RouterLink>
            </div>
          </div>
          <div style={{ maxWidth: maxWidth, flex: 1 }} class="top-nav-header-menu" >
            <BaseMenu
              collapsed={collapsed}
              menus={menus}
              mode="horizontal"
              theme={theme}
              onSelect={this.onSelect}
            />
          </div>
          <RightContent isMobile={isMobile} isTopMenu={true} theme={theme}/>
        </div>
      </div>
    )
  }
}
</script>

<style lang="less" scoped>
@import "./index.less";
</style>
