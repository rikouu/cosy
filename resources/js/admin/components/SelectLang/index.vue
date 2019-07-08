<script>
import { Dropdown, Menu, Icon } from 'ant-design-vue'

const { Item } = Menu

const languageLabels = {
  'zh_CN': '简体中文',
  'en_US': 'English'
}

const languageIcons = {
  'zh_CN': '🇨🇳',
  'en_US': '🇬🇧'
}

const locales = ['zh_CN', 'en_US']

const SelectLang = {
  name: 'SelectLang',
  inject: ['reload'],
  methods: {
    getLocale () {
      return this.$i18n.locale
    },
    changeLang ({ key }) {
      const locale = key
      this.$store.dispatch('app/SetLocale', locale)
      this.$i18n.locale = locale
      this.$message.success(this.$t('navBar.lang.switch'))
      this.reload()
    }
  },
  render () {
    const selectedLang = this.getLocale()

    const langMenu = (
      <Menu class="menu" selectedKeys={[selectedLang]} onClick={this.changeLang}>
        {locales.map(locale => (
          <Item key={locale}>
            <span role="img" aria-label={languageLabels[locale]}>
              {languageIcons[locale]}
            </span>{' '}
            {languageLabels[locale]}
          </Item>
        ))}
      </Menu>
    )
    return (
      <Dropdown overlay={langMenu} placement="bottomRight" overlayClassName="header-dropdown">
        <span class="dropDown">
          <Icon type="global" />
        </span>
      </Dropdown>
    )
  }
}

export default SelectLang
</script>

<style lang="less" scoped>
@import '~ant-design-vue/es/style/themes/default';

.menu {
  .anticon {
    margin-right: 8px;
  }
  .ant-dropdown-menu-item {
    min-width: 160px;
  }
}

.dropDown {
  line-height: @layout-header-height;
  vertical-align: top;
  cursor: pointer;
  > i {
    font-size: 16px !important;
    transform: none !important;
    svg {
      position: relative;
      top: -1px;
    }
  }
}

</style>
