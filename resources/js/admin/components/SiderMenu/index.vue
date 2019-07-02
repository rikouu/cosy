<script>
import SiderMenu from './SiderMenu.vue'
import { Drawer } from 'ant-design-vue'

export default {
  name: 'SiderMenuWrapper',
  components: {
    SiderMenu: SiderMenu,
    ADrawer: Drawer
  },
  render (createElement) {
    const isMobile = false
    const collapsed = true
    return isMobile ? (
      <ADrawer
        {...{
          props: {
            visible: !collapsed,
            placement: 'left',
            wrapClassName: 'sider-menu',
            closable: false
          },
          style: {
            padding: 0,
            height: '100vh'
          }
        }}
      >
        <SiderMenu {...{
          props: {
            collapsed: (isMobile ? false : collapsed)
          }
        }} />
      </ADrawer>
    ) : (
      <SiderMenu {...{
        class: 'sider-menu'
      }} />
    )
  },
  methods: {
    renderMenu () {
      return <SiderMenu></SiderMenu>
    }
  }
}
</script>

<style lang="less" scoped>
</style>
