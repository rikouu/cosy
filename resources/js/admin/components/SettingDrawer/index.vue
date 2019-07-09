<script>
import { Drawer, Divider, List, Alert, Icon, Select, Switch, Tooltip } from 'ant-design-vue'
import BlockCheckbox from './BlockCheckbox'
import ThemeColor from './ThemeColor'
import { themeMixin } from '@/mixins'

const { Item } = List
const ListItem = Item

const { Option } = Select
const SelectOption = Option

export default {
  name: 'SettingDrawer',
  mixins: [themeMixin],
  data () {
    return {
      collapse: false
    }
  },
  mounted () {
    this.collapse = true
    setTimeout(() => {
      this.collapse = false
    }, 20)
  },
  methods: {
    togglerContent () {
      this.collapse = !this.collapse
    },
    changeSetting (setting, value) {
      const config = {
        layoutMode: 'ToggleLayoutMode',
        fixedHeader: 'ToggleFixedHeader',
        navTheme: 'ToggleTheme',
        primaryColor: 'ToggleColor',
        contentWidth: 'ToggleContentWidth',
        autoHideHeader: 'ToggleFixedHeaderHidden',
        fixSiderbar: 'ToggleFixSidebar',
        colorWeak: 'ToggleWeak'
      }
      if (config[setting]) {
        this.$store.dispatch(`theme/${config[setting]}`, value)
      }
    }
  },
  render () {
    const { collapse, navTheme, layoutMode, primaryColor, contentWidth, fixedHeader, autoHideHeader, colorWeak, fixSiderbar, changeSetting } = this
    return (
      <div ref="settingDrawer">
        <Drawer
          visible={collapse}
          width="300"
          placement="right"
          zIndex={999}
          getContainer={() => this.$refs.settingDrawer}
          onClose={this.togglerContent}
        >
          <div class="content">
            <div style={{ marginBottom: 24 }}
            >
              <h3 class="title">
                整体风格设置
              </h3>
              <BlockCheckbox
                list={[
                  {
                    key: 'dark',
                    url: require('@/assets/setting/darkTheme.svg'),
                    title: '暗色菜单风格'
                  },
                  {
                    key: 'light',
                    url: require('@/assets/setting/lightTheme.svg'),
                    title: '亮色菜单风格'
                  }
                ]}
                value={navTheme}
                onChange={value => changeSetting('navTheme', value)}
              />
            </div>

            <ThemeColor
              title="主题色"
              value={primaryColor}
              onChange={color => changeSetting('primaryColor', color)}
            />

            <Divider />

            <div style={{ marginBottom: '24px' }}>
              <h3 class="title">
                导航模式
              </h3>
              <BlockCheckbox
                list={[
                  {
                    key: 'sidemenu',
                    url: require('@/assets/setting/sidemenu.svg'),
                    title: '侧边菜单布局'
                  },
                  {
                    key: 'topmenu',
                    url: require('@/assets/setting/topmenu.svg'),
                    title: '顶部菜单布局'
                  }
                ]}
                value={layoutMode}
                onChange={value => changeSetting('layoutMode', value)}
              />
            </div>

            <List split={false}>
              <ListItem>
                <span style={{ opacity: '' }}>内容区域宽度</span>
                <Select
                  slot="actions"
                  value={contentWidth}
                  defaultValue={contentWidth}
                  size="small"
                  style={{ width: '80px;' }}
                  onSelect={value => changeSetting('contentWidth', value)}
                >
                  <SelectOption key="Fluid" value="Fluid">
                    流式
                  </SelectOption>
                  {layoutMode === 'topmenu' && (<SelectOption key="Fixed" value="Fixed">定宽</SelectOption>)}
                </Select>
              </ListItem>
              <ListItem>
                <span style={{ opacity: '' }}>固定 Header</span>
                <Switch
                  slot="actions"
                  size="small"
                  checked={fixedHeader}
                  onChange={(checked) => changeSetting('fixedHeader', checked)}
                />
              </ListItem>
              <Tooltip title="固定 Header 时可配置" placement="left">
                <ListItem>
                  <span style={{ opacity: (!fixedHeader ? '0.5' : '') }}>下滑时隐藏 Header</span>
                  <Switch
                    slot='actions'
                    size="small"
                    disabled={!fixedHeader}
                    checked={autoHideHeader}
                    onChange={(checked) => changeSetting('autoHideHeader', checked)}
                  />
                </ListItem>
              </Tooltip>

              <Tooltip title="侧边菜单布局时可配置" placement="left">
                <ListItem>
                  <span style={{ opacity: (layoutMode === 'topmenu' ? '0.5' : '') }}>固定侧边菜单</span>
                  <Switch
                    slot="actions"
                    size="small"
                    disabled={layoutMode === 'topmenu'}
                    checked={fixSiderbar}
                    onChange={(checked) => changeSetting('fixSiderbar', checked)}
                  />
                </ListItem>
              </Tooltip>
            </List>

            <Divider />

            <div style="margin-bottom: 24px;">
              <h3 class="title">
            其他设置
              </h3>
              <ListItem>
                <span style={{ opacity: '' }}>色弱模式</span>
                <Switch
                  slot="actions"
                  size="small"
                  checked={colorWeak}
                  onChange={checked => changeSetting('colorWeak', checked)}
                />
              </ListItem>
            </div>

            <Divider />

            <Button block icon="copy">
              拷贝设置
            </Button>
          </div>
          <Alert type="warning" class="productionHint">
            <div slot="message">
              配置栏只在开发环境用于预览，生产环境不会展现，请拷贝后手动修改配置文件
              <a
                href="https://u.ant.design/pro-v2-default-settings"
                target="_blank"
                rel="noopener noreferrer"
              >src/defaultSettings.js</a>
            </div>
          </Alert>
          <div class="handle" onClick={this.togglerContent}>
            <Icon type={collapse ? 'close' : 'setting'} style="color: #fff; font-size: 20px;" />
          </div>
        </Drawer>
      </div>
    )
  }
}
</script>

<style lang="less" scoped>
@import "~ant-design-vue/es/style/themes/default.less";

.content {
  position: relative;
  min-height: 100%;
  background: #fff;
}

.color_block {
  display: inline-block;
  width: 38px;
  height: 22px;
  margin: 4px;
  margin-right: 12px;
  vertical-align: middle;
  border-radius: 4px;
  cursor: pointer;
}

.title {
  margin-bottom: 12px;
  color: @heading-color;
  font-size: 14px;
  line-height: 22px;
}

.handle {
  position: absolute;
  top: 240px;
  right: 300px;
  z-index: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 48px;
  height: 48px;
  font-size: 16px;
  text-align: center;
  background: @primary-color;
  border-radius: 4px 0 0 4px;
  cursor: pointer;
  pointer-events: auto;
}

.productionHint {
  margin-top: 16px;
  font-size: 12px;
}
</style>
