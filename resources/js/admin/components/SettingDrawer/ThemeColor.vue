<script>
import { Icon, Tooltip } from 'ant-design-vue'
const colorList = [
  {
    key: 'dust',
    color: '#F5222D'
  },
  {
    key: 'volcano',
    color: '#FA541C'
  },
  {
    key: 'sunset',
    color: '#FAAD14'
  },
  {
    key: 'cyan',
    color: '#13C2C2'
  },
  {
    key: 'green',
    color: '#52C41A'
  },
  {
    key: 'daybreak',
    color: '#1890FF'
  },
  {
    key: 'geekblue',
    color: '#2F54EB'
  },
  {
    key: 'purple',
    color: '#722ED1'
  }
]

export default {
  name: 'ThemeColor',
  components: {
    AIcon: Icon,
    ATooltip: Tooltip
  },
  props: {
    title: {
      type: String,
      default: ''
    },
    colors: {
      type: Array,
      default: function () {
        return colorList
      }
    },
    value: {
      type: String,
      required: true
    }
  },
  methods: {
    onChange (color) {
      // this.$emit('change', color)
    }
  },
  render () {
    const { colors, title, value } = this
    return (
      <div class="themeColor">
        <h3 class="title">{{ title }}</h3>
        <div class="content">
          {colors.map(color => {
            return (
              <Tooltip key={color.color} title={color.key}>
                <div
                  class="colorBlock"
                  style={{
                    backgroundColor: color.color
                  }}
                  onClick={this.onChange(color.color)}
                >
                  {value === color.color && <Icon type="check" />}
                </div>
              </Tooltip>
            )
          })}
        </div>
      </div>
    )
  }
}
</script>

<style lang="less" scoped>
@import "~ant-design-vue/es/style/themes/default.less";

.themeColor {
  margin-top: 24px;
  overflow: hidden;
  .title {
    margin-bottom: 12px;
    color: rgba(0, 0, 0, 0.65);
    font-size: 14px;
    line-height: 22px;
  }
  .colorBlock {
    float: left;
    width: 20px;
    height: 20px;
    margin-right: 8px;
    color: #fff;
    font-weight: bold;
    text-align: center;
    border-radius: 2px;
    cursor: pointer;
  }
}
</style>
