<script>
import { Card, Col, Avatar, Row, Button, Input, Form, Icon } from 'ant-design-vue'
import { list, destroy } from '@/api/user'

const FormItem = Form.Item

export default {
  name: 'Index',
  data () {
    return {
      selectedRowKeys: [],
      columns: [
        {
          title: '头像',
          dataIndex: 'avatar',
          customRender: (avatar) => (<Avatar src={avatar} />)
        },
        {
          title: '用户名',
          dataIndex: 'name'
        },
        {
          title: '昵称',
          dataIndex: 'display_name'
        },
        {
          title: '邮箱',
          dataIndex: 'email',
          customRender: (email) => email ? (<a href={`mailto:${email}`}>{ email }</a>) : '—'
        },
        {
          title: '网站',
          dataIndex: 'url',
          customRender: (url) => url ? (<a target="_blank" href={url}>{ url }</a>) : '—'
        },
        {
          title: '创建时间',
          dataIndex: 'created_at'
        },
        {
          title: '操作',
          key: 'action'
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
    let query = {}
    this.query = query
    this.loading = true
    query = Object.assign(query, this.$route.query)
    console.log(query)
    list(query).then(res => {
      console.log(res)
      const { data, meta: { total, per_page: perPage, current_page: currentPage } } = res
      this.data = data

      console.log(total)
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
  },
  methods: {
    handleSubmit (e) {
      e.preventDefault()
      this.form.validateFields((err, values) => {
        if (!err) {
          this.handleSearch(values)
        }
      })
    },
    handleSearch (query = {}) {
      this.query = query
      this.loading = true

      query = Object.assign(query, this.$route.query)
      console.log(query)
      list(query).then(res => {
        console.log(res)
        const { data, meta: { total, per_page: perPage, current_page: currentPage } } = res
        this.data = data

        console.log(total)
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
    },
    toggleForm () {

    },
    handleCreate (e) {
      e.preventDefault()
      this.$router.push({
        name: 'user.create'
      })
    },
    handleMultiDelete (e) {
      e.preventDefault()
      console.log(this.selectedRowKeys)
    },
    handleTableDelete (row) {
      console.log(row)
      destroy(row).then(res => {
        console.log(res)
      })
    },
    onSelectChange (selectedRowKeys) {
      console.log('selectedRowKeys changed: ', selectedRowKeys)
      this.selectedRowKeys = selectedRowKeys
    },
    handleTableChange (pagination, filters, sorter) {
      console.log(pagination)
      const query = {
        per_page: pagination.pageSize,
        page: pagination.current
      }
      this.loading = true
      list(query).then(res => {
        console.log(res)
        this.data = res.data.data

        const paginationProps = {
          showSizeChanger: true,
          showQuickJumper: true,
          total: parseInt(res.data.total),
          pageSize: parseInt(res.data.per_page),
          current: res.data.current_page
        }
        this.pagination = paginationProps
        this.loading = false
      })
      // index()
    }
  },
  render () {
    const { form, loading, columns, pagination, data, selectedRowKeys } = this
    return (<Card>
      <div class="tableList">
        <div class="tableListForm">
          <Form form={form} layout="inline" onSubmit={this.handleSubmit}>
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
                <span class="submitButtons">
                  <Button type="primary" htmlType="submit">
                  查询
                  </Button>
                  <Button onClick={() => console.log(2222)}>
                  重置
                  </Button>
                  <a onClick={this.toggleForm}>
                  展开 <Icon type="down" />
                  </a>
                </span>
              </Col>
            </Row>
          </Form>
        </div>
        <div class="tableListOperator">
          <Button type="primary" onClick={(e) => this.handleCreate(e)} >新建</Button>
          <Button type="danger" onClick={(e) => this.handleTableDelete(e)} />
        </div>
        <Table
          rowKey="id"
          columns={columns}
          loading={loading}
          dataSource={data}
          pagination={pagination}
          rowSelection={{ selectedRowKeys: selectedRowKeys, onChange: this.onSelectChange }}
          onChange={this.handleTableChange}
        />
      </div>
    </Card>)
  }
}
</script>

<style lang="less" scoped>
@import "~ant-design-vue/es/style/themes/default.less";

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
