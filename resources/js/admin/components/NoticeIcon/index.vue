<script>
import { Badge, Dropdown, Spin, Tabs, Icon } from 'ant-design-vue'
import NoticeList from './NoticeList'
const { TabPane } = Tabs

export default {
  name: 'NoticeIcon',
  components: {
    NoticeList,
    ABadge: Badge,
    ADropdown: Dropdown,
    ASpin: Spin,
    ATabs: Tabs,
    ATabPane: TabPane
  },
  data () {
    return {
      visible: false,
      loading: false,
      count: 0
    }
  },
  methods: {
    onTabChange () {},
    handleVisibleChange (visible) {
      this.visible = visible
      this.$emit('popupVisibleChange', visible)
    }
  },
  render () {
    const { visible, count, loading } = this

    const notificationBox = (
      <Spin spinning={loading} delay={300}>
        <Tabs class="tabs">
          <TabPane key={1} tab="通知(0)">
            <NoticeList
              emptyText="暂无通知"
              emptyImage="https://gw.alipayobjects.com/zos/rmsportal/wAhyIChODzsoKIOBHcBk.svg"
            />
          </TabPane>
          <TabPane key={2} tab="消息(0)">
            <NoticeList
              emptyText="暂无消息"
              emptyImage="https://gw.alipayobjects.com/zos/rmsportal/sAuJeJzSKbUmHfBQRzmZ.svg"
            />
          </TabPane>
          <TabPane key={3} tab="待办(0)">
            <NoticeList
              emptyText="暂无待办"
              emptyImage="https://gw.alipayobjects.com/zos/rmsportal/HsIsxMZiWKrNUavQUXqx.svg"
            />
          </TabPane>
        </Tabs>
      </Spin>
    )

    return (
      <Dropdown
        visible={visible}
        onVisibleChange={this.handleVisibleChange}
        overlay={notificationBox}
        placement="bottomRight"
        trigger={['click']}
        overlayClassName="header-dropdown notice-icon-popover"
      >
        <span class={['noticeButton', { opened: visible }]}>
          <Badge count={count} style={{ boxShadow: 'none' }} class="badge">
            <Icon type="bell" class="icon" />
          </Badge>
        </span>
      </Dropdown>
    )
  }
}
</script>

<style lang="less" scoped>
@import "./index.less";
</style>

<style lang="less">
.notice-icon-popover {
  position: relative;
  width: 336px;

  .tabs {
    .ant-tabs-nav-scroll {
      text-align: center;
    }
    .ant-tabs-bar {
      margin-bottom: 0;
    }
  }
}
</style>
