<script>
import { Menu, Icon } from 'ant-design-vue'
import path from 'path'
import { isUrl } from '@/utils/utils'
import IconFont from '@/components/IconFont'
import { mapGetters } from 'vuex'

const { SubMenu, Item } = Menu

export default {
  name: 'BaseMenu',
  components: {
    Icon: Icon,
    Menu: Menu,
    MenuItem: Menu.Item
  },
  props: {
    menus: {
      type: Array,
      required: true
    },
    theme: {
      type: String,
      required: true
    },
    mode: {
      type: String,
      required: false,
      default: 'inline'
    },
    collapsed: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  data () {
    return {
      openKeys: [],
      selectedKeys: [],
      cachedOpenKeys: []
    }
  },
  computed: {
    ...mapGetters('theme', ['isMobile']),
    rootSubmenuKeys (vm) {
      const keys = []
      vm.menus.forEach(item => keys.push(path.resolve(item.path)))
      return keys
    }
  },
  watch: {
    collapsed (val) {
      if (val) {
        this.cachedOpenKeys = this.openKeys.concat()
        this.openKeys = []
      } else {
        this.openKeys = this.cachedOpenKeys
      }
    },
    $route: function () {
      this.updateMenu()
    }
  },
  created () {
    this.updateMenu()
  },
  methods: {
    renderIcon (icon) {
      if (typeof icon === 'string') {
        if (isUrl(icon)) {
          return (
            <Icon
              components={{ template: `<img src="${icon}" class="icon" />` }}
            />
          )
        }
        if (icon.startsWith('icon-')) {
          return <IconFont type={icon} />
        }
        return <Icon type={icon !== undefined ? icon : ''} />
      }
      return icon === 'none' || icon === undefined ? null : (
        <Icon type={icon !== undefined ? icon : ''} />
      )
    },
    renderMenuItem (menu, pIndex, index, basePath) {
      const target = menu.meta.target || null
      const routePath = path.resolve(basePath, menu.path)
      return (
        <Item key={routePath}>
          <RouterLink to={{ path: routePath, target: target }}>
            {this.renderIcon(menu.meta.icon)}
            <span>{menu.meta.title}</span>
          </RouterLink>
        </Item>
      )
    },
    renderSubMenu (menu, pIndex, index, basePath) {
      const that = this
      const subItem = [
        (<span slot="title">
          {this.renderIcon(menu.meta.icon)}
          <span> {[menu.meta.title]} </span>
        </span>)
      ]

      const itemArr = []
      const pIndex_ = `${pIndex}_${index}`
      const routePath = path.resolve(basePath, menu.path)
      if (!menu.hideChildrenInMenu) {
        menu.children.forEach((item, i) => {
          itemArr.push(that.renderItem(item, pIndex_, i, routePath))
        })
      }
      return <SubMenu key={routePath}>{subItem.concat(itemArr)}</SubMenu>
    },
    renderItem (menu, pIndex, index, basePath) {
      if (!menu.hidden) {
        return menu.children && !menu.hideChildrenInMenu
          ? this.renderSubMenu(menu, pIndex, index, basePath)
          : this.renderMenuItem(menu, pIndex, index, basePath)
      }
    },
    renderMenu (menus, basePath) {
      const that = this
      const menuArr = []
      menus.forEach((menu, i) => {
        if (!menu.hidden) {
          menuArr.push(that.renderItem(menu, '0', i, basePath))
        }
      })
      return menuArr
    },
    onOpenChange (openKeys) {
      const mainMenu = this.rootSubmenuKeys
      const latestOpenKey = openKeys.filter(key => mainMenu.includes(key))
      if (latestOpenKey.length > 1) {
        this.openKeys = [openKeys.pop()]
      } else {
        this.openKeys = [...openKeys]
      }
    },
    updateMenu () {
      const routes = this.$route.matched
        .concat()
        .filter(item => item.path)
        .map(item => {
          return item.path
        })

      if (routes.length >= 4 && this.$route.meta.hidden) {
        routes.pop()
      }
      let routePath = routes.pop()
      let selectedKeys = [routePath].map(item => {
        if (item !== '/') {
          return path.resolve(item)
        }
        return item
      })

      this.selectedKeys = selectedKeys

      const openKeys = []
      routes.forEach(item => {
        if (item.length > 0) {
          if (this.mode === 'inline') {
            openKeys.push(item)
          }
        }
      })

      this.collapsed
        ? (this.cachedOpenKeys = openKeys)
        : (this.openKeys = openKeys)
    }
  },
  render () {
    const { theme, mode, openKeys, selectedKeys, menus } = this
    return (
      <Menu
        theme={theme}
        mode={mode}
        openKeys={openKeys}
        selectedKeys={selectedKeys}
        class={[
          {
            'top-nav-menu': mode === 'horizontal'
          }
        ]}
        onOpenChange={this.onOpenChange}
        onSelect={obj => {
          this.selectedKeys = obj.selectedKeys
          this.$emit('select', obj)
        }}
      >
        {this.renderMenu(menus, '/')}
      </Menu>
    )
  }
}
</script>

<style lang="less" scoped>
.icon {
  width: 14px;
  vertical-align: baseline;
}
</style>
