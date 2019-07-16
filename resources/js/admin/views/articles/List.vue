<script >
import { Card, Col, Row, Input, Select, Table, Form, Button, Icon } from 'ant-design-vue'
import { index } from '@/api/article'

const FormItem = Form.Item

export default {
  name: 'ArticleList',
  data () {
    return {
      selectedRowKeys: [],
      modalVisible: false,
      columns: [
        {
          title: '标题',
          dataIndex: 'title',
          width: 200,
          customRender: (title, record) => {
            return (
              <RouterLink to={{ name: 'article.edit', params: { id: record.id } }}>
                { title }
              </RouterLink>)
          }
        },
        {
          title: '作者',
          dataIndex: 'user',
          width: 160,
          customRender: (user, record) => {
            return user ? (<RouterLink to={{ name: 'article.index', query: { user: user.id } }}>
              {user.display_name || user.name}
            </RouterLink>) : '—'
          }
        },
        {
          title: '分类',
          dataIndex: 'category',
          width: 160,
          customRender: (category, record) => {
            return category ? (<RouterLink to={{ name: 'article.index', query: { category: category.id } }}>
              {category.name}
            </RouterLink>) : '—'
          }
        },
        {
          title: '发布时间',
          width: 200,
          dataIndex: 'published_at'
        }
      ],
      form: this.$form.createForm(this),
      data: [],
      loading: false,
      pagination: {},
      query: {}
    }
  },
  created () {
    this.loading = true
    index().then(res => {
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
  },
  methods: {

    handleSearch (query = {}) {
      this.query = query
      this.loading = true

      query = Object.assign(query, this.$route.query)
      console.log(query)
      index(query).then(res => {
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

    handleSubmit (e) {
      e.preventDefault()
      this.form.validateFields((err, values) => {
        if (!err) {
          this.handleSearch(values)
        }
      })
    },

    handleCreate (e) {
      e.preventDefault()
      this.$router.push({
        name: 'article.create'
      })
    },

    toggleForm () {

    },

    handleTableChange (pagination, filters, sorter) {
      const query = Object.assign(this.query, {
        per_page: pagination.pageSize,
        page: pagination.current
      })

      this.handleSearch(query)
    }
  },
  render () {
    const { form, loading, data, pagination, selectedRowKeys } = this

    return (
      <Card>
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
                    <Button onClick={() => console.log(2222) }>
                  重置
                    </Button>
                    <a onClick="toggleForm">
                  展开 <Icon type="down" />
                    </a>
                  </span>
                </Col>
              </Row>
            </Form>
          </div>
          <div class="tableListOperator">
            <Button icon="plus" type="primary" onClick={() => console.log(2222)}>
            新建
            </Button>
            <span>
              <Button>批量操作</Button>
            </span>
          </div>
          <Table
            rowKey="id"
            columns={this.columns}
            loading={loading}
            dataSource={data}
            pagination={pagination}
            rowSelection={{ selectedRowKeys: selectedRowKeys }}
            onChange={this.handleTableChange}
          />
        </div>
      </Card>
    )
  }
}
</script>

<style lang="less" scoped>
@import '~ant-design-vue/es/style/themes/default';

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
