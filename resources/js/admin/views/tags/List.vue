<script >
import { Card, Col, Row, Table, Select, Input, Form, Button, Icon, Dropdown, Menu } from 'ant-design-vue'
import { index } from '@/api/tag'

const FormItem = Form.Item
const MenuItem = Menu.Item
const { Option } = Select.Option

export default {
  name: 'Index',
  data () {
    return {
      selectedRowKeys: [],
      columns: [
        {
          title: '名称',
          dataIndex: 'name',
          customRender: (name, record) => {
            return (
              <RouterLink to={{ name: 'tag.edit', params: { id: record.id } }}>
                { name }
              </RouterLink>)
          }
        },
        {
          title: '别名',
          dataIndex: 'slug'
        },
        {
          title: '描述',
          dataIndex: 'description',
          customRender: (description, record) => {
            return description || '—'
          }
        },
        {
          title: '总数',
          dataIndex: 'count'
        },
        {
          title: '创建时间',
          dataIndex: 'created_at',
          sorter: true
        }
      ],
      form: this.$form.createForm(this),
      data: [],
      loading: false,
      pagination: {

      }
    }
  },
  created () {
    this.loading = true
    index().then(res => {
      console.log(res)
      const { data, meta: { total, per_page: perPage, current_page: currentPage } } = res
      this.data = data

      console.log(total)
      const paginationProps = {
        showSizeChanger: true,
        total: parseInt(total),
        pageSize: parseInt(perPage),
        current: currentPage
      }
      this.pagination = paginationProps
      this.loading = false
    })
  },
  methods: {
    getActionButtons () {
      const isEmpty = !(this.selectedRowKeys && this.selectedRowKeys.length > 0)
      if (isEmpty) {
        return (
          <Row gutter={{ md: 8, lg: 24, xl: 48 }}>
            <Col md={8} sm={24}>
              <FormItem label="用户名">
                <Input
                  v-decorator={[
                    'username',
                    {
                      rules: [
                      // { required: true, message: $t('validation.required', { attribute: $t('validation.attributes.username') }) }
                      ],
                      validateTrigger: ['change', 'blur']
                    }
                  ]}
                  placeholder="请输入"
                />
              </FormItem>
            </Col>

            <Col md={8} sm={24}>
              <FormItem label="权限">
                <Select defaultValue={0} placeholder="请选择" style="width: 100%;">
                  <Option value={0}>
              全部
                  </Option>
                  <Option value={1}>
              管理员
                  </Option>
                </Select>
              </FormItem>
            </Col>

            <Col md={8} sm={24}>
              <span class="submitButtons">
                <Button type="primary" htmlType="submit">查询</Button>
                <Button type="primary" onClick={(e) => this.handleCreate(e)} >新建</Button>
              </span>
            </Col>
          </Row>)
      } else {
        return (
          <Row gutter={{ md: 8, lg: 24, xl: 48 }}>
            <Col md={6} sm={24}>
              <span class="submitButtons">
                <Button onClick={this.handleDelete}>删除</Button>
                <Dropdown overlay={
                  <Menu onClick={this.handleMoreAction}>
                    <MenuItem key="1">
                      <Icon type="delete" />删除
                    </MenuItem>
                  </Menu>
                }>
                  <Button>
                        批量操作
                    <Icon type="down" />
                  </Button>
                </Dropdown>
              </span>
            </Col>
          </Row>
        )
      }
    },
    handleSearch (value) {
      console.log(value)
    },
    toggleForm () {

    },
    handleCreate (e) {
      e.preventDefault()
      this.$router.push({
        name: 'tag.create'
      })
    },
    onSelectChange (selectedRowKeys) {
      this.selectedRowKeys = selectedRowKeys
    },
    handleTableChange (pagination, filters, sorter) {
      console.log(pagination)
      const query = {
        per_page: pagination.pageSize,
        page: pagination.current
      }
      this.loading = true
      index(query).then(res => {
        const { data, meta: { total, per_page: perPage, current_page: currentPage } } = res
        this.data = data

        const paginationProps = {
          showSizeChanger: true,
          showQuickJumper: true,
          total: parseInt(total),
          pageSize: parseInt(perPage),
          current: currentPage
        }
        this.pagination = paginationProps
        this.loading = false
      })
      // index()
    }
  },
  render () {
    const { form, columns, loading, data, pagination, selectedRowKeys } = this
    return (
      <Card>
        <div class="tableList">
          <div class="tableListForm">
            <Form form={form} layout="inline" onSubmit={this.handleSearch}>
              { this.getActionButtons() }
            </Form>
          </div>

          <Table
            rowKey="id"
            columns={columns}
            loading={loading}
            dataSource={data}
            pagination={pagination}
            rowSelection={{ selectedRowKeys: selectedRowKeys, onChange: this.onSelectChange }}
            onChange={this.handleTableChange}
          >
          </Table>
        </div>
      </Card>
    )
  }
}
</script>

<style lang="less" scoped>
@import "~@/styles/variables.less";
@import "~@/styles/components/utils.less";

.tableList {
  .tableListOperator {
    margin-bottom: 16px;
    button {
      margin-right: 8px;
    }
  }
}

.tableListForm {
  :global(.ant-form-item) {
    display: flex;
    margin-right: 0;
    margin-bottom: 24px;
    > .ant-form-item-label {
      width: auto;
      padding-right: 8px;
      line-height: 32px;
    }
    .ant-form-item-control {
      line-height: 32px;
    }
    :global(.ant-form-item-control-wrapper) {
      flex: 1;
    }
  }
  .submitButtons {
    display: block;
    margin-bottom: 24px;
    white-space: nowrap;
    :global(.ant-btn) {
      margin-right: 8px;
    }
  }
}

@media screen and (max-width: @screen-lg) {
  .tableListForm :global(.ant-form-item) {
    margin-right: 24px;
  }
}

@media screen and (max-width: @screen-md) {
  .tableListForm :global(.ant-form-item) {
    margin-right: 8px;
  }
}
</style>
