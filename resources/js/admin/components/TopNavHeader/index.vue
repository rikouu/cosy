<script >
import BaseMenu from '@/components/SiderMenu/BaseMenu'
import RightContent from '@/components/RightContent'
import { themeMixin } from '@/mixins'
import config from '@/config/base'
import logo from '@img/favicon.png'

export default {
  name: 'TopNavHeader',
  components: {
    BaseMenu,
    RightContent
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
    }
  },
  data () {
    return {
      title: config.name,
      main: undefined
    }
  },
  computed: {
    wide () {
      return this.contentWidth === 'Fixed'
    },
    maxWidth () {
      const width = (this.contentWidth === 'Fixed' ? 1200 : window.innerWidth) - 280 - 120 - 40
      return `${width}px`
    }
  },
  methods: {
    onSelect () {
      console.log(222)
    }
  },
  render () {
    const { navTheme, menus, collapsed, title, maxWidth, contentWidth } = this
    return (
      <div class={`top-nav-header ${navTheme === 'light' ? 'light' : ''}` }>
        <div ref="maim" class={`top-nav-header-main ${contentWidth === 'Fixed' ? 'wide' : ''}` }>
          <div class="top-nav-header-left">
            <div id="logo" class="top-nav-header-logo">
              <RouterLink to={{ path: '/' }}>
                <img src={logo} alt="logo" />
                <h1>{{ title }}</h1>
              </RouterLink>
            </div>
          </div>
          <div
            style={{ maxWidth: maxWidth, flex: 1 }}
            class="top-nav-header-menu"
          >
            <BaseMenu
              collapsed={collapsed}
              menu={menus}
              mode="horizontal"
              theme={navTheme}
              onSelect={this.onSelect}
            />
          </div>
          <RightContent />
        </div>
      </div>
    )
  }
}
</script>

<style lang="less" scoped>
@import "./index.less";
</style>
