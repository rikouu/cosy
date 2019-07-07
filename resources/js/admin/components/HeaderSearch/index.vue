
<script>
import { AutoComplete, Icon } from 'ant-design-vue'
export default {
  name: 'HeaderSearch',
  components: {
    AAutoComplete: AutoComplete,
    AIcon: Icon
  },
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
        class={'headerSearch'}
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
          class={['input', { 'show': searchMode }]}
          dataSource={dataSource}
          value={value}
          onChange={this.onSearchChange}
          onSearch={this.onSearch}
          onBlur={this.leaveSearchMode}
        >
          <Input
            ref="searchInput"
            placeholder={placeholder}
            value={value}
            onKeydown={(e) => this.onKeyDown(e)}
            onBlur={this.leaveSearchMode}
          />
        </AutoComplete>
      </span>
    )
  }
}
</script>

<style lang="less" >
@import "~ant-design-vue/es/style/themes/default";

.headerSearch {
  .anticon-search {
    font-size: 16px;
    cursor: pointer;
  }
  .input {
    width: 0;
    background: transparent;
    border-radius: 0;
    transition: width 0.3s, margin-left 0.3s;
    .ant-select-selection {
      background: transparent;
    }
    input {
      padding-right: 0;
      padding-left: 0;
      border: 0;
      box-shadow: none !important;
    }
    &,
    &:hover,
    &:focus {
      border-bottom: 1px solid @border-color-base;
    }
    &.show {
      width: 210px;
      margin-left: 8px;
    }
  }
}
</style>
