<script>
import { Icon } from 'ant-design-vue'
import SelectLang from '@/components/SelectLang'
import HeaderSearch from '@/components/HeaderSearch'
import NoticeIcon from '@/components/NoticeIcon'
import { themeMixin } from '@/mixins'
import { mapGetters } from 'vuex'
import Avatar from './AvatarDropdown'

export default {
  name: 'RightContent',
  mixins: [themeMixin],
  computed: {
    ...mapGetters('auth', ['user']),
    darkClass () {
      if (this.isMobile || !this.isTopMenu) {
        return false
      }
      return this.navTheme === 'dark'
    }
  },
  methods: {
    logout () {
      const that = this
      this.$confirm({
        title: '提示',
        content: '真的要注销登录吗 ?',
        onOk () {
          return that.$store
            .dispatch('auth/Logout')
            .then(() => {
              location.reload()
            })
            .catch(() => {
              console.log('Oops errors!')
            })
        },
        onCancel () {}
      })
    },
    onSearch (value) {
      console.log(value)
    }
  },
  render () {
    return (
      <div class={{ 'right': true, 'dark': this.darkClass }}>
        <HeaderSearch class="action search" onSearch={this.onSearch} placeholder="站内搜索" />
        <NoticeIcon class="action" />
        <Avatar />
        <SelectLang class="action" />
      </div>
    )
  }
}
</script>

<style lang="less" scoped>
@import "./index.less";
</style>
