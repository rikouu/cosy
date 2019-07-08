
<script>
import { Icon } from 'ant-design-vue'
import RightContent from '@/components/RightContent'
import { themeMixin } from '@/mixins'
import Logo from '@img/favicon.png'

export default {
  name: 'GlobalHeader',
  components: {
    RightContent
  },
  mixins: [
    themeMixin
  ],
  props: {
    collapsed: {
      type: Boolean,
      required: false,
      default: false
    }
    // collapse: {
    //   type: Function,
    //   required: true
    // }
  },
  methods: {
    toggle () {
      this.$emit('collapse', !this.collapsed)
      // this.collapse(!this.collapsed)
    }
  },
  render () {
    const { collapsed, isMobile } = this
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
        <RightContent />
      </div>
    )
  }
}
</script>

<style lang="less" scoped>
@import "./index.less";
</style>
