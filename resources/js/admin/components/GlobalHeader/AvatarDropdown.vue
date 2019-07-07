<script>
import { Avatar, Icon, Menu, Spin, Dropdown } from 'ant-design-vue'
import { mapGetters } from 'vuex'

const { Item, Divider } = Menu

export default {
  name: 'AvatarDropdown',
  data () {
    return {

    }
  },
  computed: {
    ...mapGetters('auth', ['user'])
  },
  render () {
    const { user } = this
    return user && user.display_name ? (
      <Dropdown class="action account" overlayClassName="headerDropdown">
        <span class="dropDown">
          <Avatar class="avatar" size="small" src={user.avatar} />
          <span class="name">{ user.display_name }</span>
        </span>
        <Menu slot='overlay' class="menu">
          <Item>
            <RouterLink to={{ name: 'profile' }}>
              <Icon type="user" />个人中心
            </RouterLink>
          </Item>
          <Item key="userinfo">
            <RouterLink to={{ path: '/user/setting' }}>
              <Icon type="setting" />账号设置
            </RouterLink>
          </Item>
          <Divider />
          <Item onClick={this.logout}>
            <Icon type="logout" />退出登录
          </Item>
        </Menu>
      </Dropdown>
    ) : (<Spin size="small" style={{ marginLeft: 8, marginRight: 8 }} />)
  }
}
</script>
