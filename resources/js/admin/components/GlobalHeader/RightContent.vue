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

<style lang="less">
@import "~ant-design-vue/es/style/themes/default";

@pro-header-hover-bg: rgba(0, 0, 0, 0.025);

.menu {
  .anticon {
    margin-right: 8px;
  }
  .ant-dropdown-menu-item {
    min-width: 160px;
  }
}

.trigger {
  height: @layout-header-height;
  padding: ~"calc((@{layout-header-height} - 20px) / 2)" 24px;
  font-size: 20px;
  cursor: pointer;
  transition: all 0.3s, padding 0s;
  &:hover {
    background: @pro-header-hover-bg;
  }
}

.right {
  float: right;
  height: 100%;
  overflow: hidden;
  .action {
    display: inline-block;
    height: 100%;
    padding: 0 12px;
    cursor: pointer;
    transition: all 0.3s;
    > i {
      color: @text-color;
      vertical-align: middle;
    }
    &:hover {
      background: @pro-header-hover-bg;
    }
    &.opened {
      background: @pro-header-hover-bg;
    }
  }
  .search {
    padding: 0 12px;
    &:hover {
      background: transparent;
    }
  }
  .account {
    .avatar {
      margin: ~"calc((@{layout-header-height} - 24px) / 2)" 0;
      margin-right: 8px;
      color: @primary-color;
      vertical-align: top;
      background: rgba(255, 255, 255, 0.85);
    }
  }
}

.dark {
  height: @layout-header-height;
  .action {
    color: rgba(255, 255, 255, 0.85);
    > i {
      color: rgba(255, 255, 255, 0.85);
    }
    &:hover,
    &.opened {
      background: @primary-color;
    }
    .ant-badge {
      color: rgba(255, 255, 255, 0.85);
    }
  }
}

@media only screen and (max-width: @screen-md) {
  .ant-divider-vertical {
    vertical-align: unset;
  }
  .name {
    display: none;
  }
  i.trigger {
    padding: 22px 12px;
  }
  .logo {
    position: relative;
    padding-right: 12px;
    padding-left: 12px;
  }
  .right {
    position: absolute;
    top: 0;
    right: 12px;
    background: #fff;
    .account {
      .avatar {
        margin-right: 0;
      }
    }
  }
}
</style>
