
<script>
import { AutoComplete, Icon, Input } from 'ant-design-vue'
export default {
  name: 'HeaderSearch',
  props: {
    placeholder: {
      type: String,
      default: '站内搜索'
    },
    dataSource: {
      type: Array,
      default: function () {
        return []
      }
    }
  },
  data () {
    return {
      searchMode: false,
      value: ''
    }
  },
  methods: {
    onSearch () {
      this.$emit('search', this.value)
    },
    onKeyDown (e) {},
    onSearchChange (value) {
      this.value = value
      this.$emit('change', value)
    },
    enterSearchMode () {
      this.searchMode = true
      setTimeout(() => {
        this.$refs.input.focus()
      }, 300)
    },
    leaveSearchMode () {
      this.value = ''
      this.searchMode = false
    }
  },
  render () {
    const { placeholder, value, searchMode, dataSource } = this
    return (
      <span
        class='header-search'
        onClick={this.enterSearchMode}
        onTransitionEnd={({ propertyName }) => {
          if (propertyName === 'width' && !searchMode) {
            console.log(2)
          }
        }}
      >
        <Icon type="search" />
        <AutoComplete
          key="AutoComplete"
          ref="input"
          class={['input', { show: searchMode }]}
          dataSource={dataSource}
          value={value}
          onChange={this.onSearchChange}
          onSearch={this.onSearch}
          onBlur={this.leaveSearchMode}
        >
          <Input
            ref="searchInput"
            placeholder={placeholder}
            aria-label={placeholder}
            value={value}
            onKeydown={e => this.onKeyDown(e)}
            onBlur={this.leaveSearchMode}
          />
        </AutoComplete>
      </span>
    )
  }
}
</script>

<style lang="less" >
@import "./index.less";
</style>
