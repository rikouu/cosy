<script>
import { Icon, Tooltip } from 'ant-design-vue'
import SelectLang from '@/components/SelectLang'
import HeaderSearch from '@/components/HeaderSearch'
import NoticeIcon from '@/components/NoticeIcon'
import { mapGetters } from 'vuex'
import Avatar from './AvatarDropdown'

export default {
  name: 'RightContent',
  props: {
    theme: {
      type: String,
      required: true
    },
    isMobile: {
      type: Boolean,
      required: true
    },
    isTopMenu: {
      type: Boolean,
      required: true
    }
  },
  computed: {
    ...mapGetters('auth', ['user']),
    darkClass () {
      if (this.isMobile || !this.isTopMenu) {
        return false
      }
      return this.theme === 'dark'
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
    const { theme, isTopMenu } = this
    const wrapClass = theme === 'dark' && isTopMenu ? 'right dark' : 'right'

    return (
      <div class={wrapClass}>
        <HeaderSearch class="action search" onSearch={this.onSearch} placeholder="站内搜索" />
        <NoticeIcon class="action" />
        <Tooltip title='Help' >
          <a target="_blank" href="https://loyep.com" rel="noopener noreferrer" class="action" >
            <Icon type="question-circle-o" />
          </a>
        </Tooltip>
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
