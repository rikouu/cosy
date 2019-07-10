
<script>
import { Icon } from 'ant-design-vue'
import RightContent from '@/components/RightContent'
import Logo from '@img/favicon.png'

export default {
  name: 'GlobalHeader',
  components: {
    RightContent
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
    isMobile: {
      type: Boolean,
      required: true
    },
    isTopMenu: {
      type: Boolean,
      default: false
    },
    theme: {
      type: String,
      required: true
    }
  },
  methods: {
    toggle () {
      this.$emit('collapse', !this.collapsed)
      // this.collapse(!this.collapsed)
    }
  },
  render () {
    const { collapsed, isMobile, isTopMenu, theme } = this
    return (
      <div class="global-header">
        {isMobile && (
          <RouterLink class="global-header-logo" to={{ path: '/' }}>
            <img src={Logo} />
          </RouterLink>
        )}
        <span class="global-header-trigger" onClick={this.toggle}>
          <Icon type={collapsed ? 'menu-unfold' : 'menu-fold'} />
        </span>
        <RightContent isMobile={isMobile} isTopMenu={isTopMenu} theme={theme}/>
      </div>
    )
  }
}
</script>

<style lang="less" scoped>
@import "./index.less";
</style>
