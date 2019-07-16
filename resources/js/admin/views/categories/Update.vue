<script>
import { Card, Col, Row, Form, Input, Button } from 'ant-design-vue'
import { update, show, store } from '@/api/category'
import { setFiledsWithErrors } from '@/utils/form'

const FormItem = Form.Item

export default {
  name: 'CategoryUpdate',
  components: {
    ACard: Card,
    ACol: Col,
    ARow: Row
  },
  props: {
    id: {
      type: [Number, String],
      required: true
    }
  },
  data () {
    return {
      form: this.$form.createForm(this),
      data: {}
    }
  },

  created () {
    this.loadInfo()
  },
  methods: {
    loadInfo () {
      if (this.id) {
        this.$nextTick(() => {
          show(this.id).then(res => {
            const { data } = res.data
            this.data = data
            const fields = this.form.getFieldsValue()
            for (let field in fields) {
              if (data.hasOwnProperty(field)) {
                fields[field] = data[field]
              }
            }
            this.form.setFieldsValue(fields)
          })
        })
      }
    },
    handleSubmit (e) {
      e.preventDefault()
      this.form.validateFields((err, values) => {
        if (!err) {
          let updateOrCreate

          if (this.id) {
            updateOrCreate = update(this.id, values)
          } else {
            updateOrCreate = store(values)
          }

          updateOrCreate.then(res => {
            const data = res.data

            if (data.errors) {
              setFiledsWithErrors(this.form, data.errors)
            } else {
              this.$notification.success({
                message: '提示',
                description: res.data.message
              })
              this.$router.push({
                name: 'category.index'
              })
            }
          })
        }
      })
    }
  },
  render () {
    const { form } = this
    return (
      <Row gutter={{ md: 24 }}>
        <Col md={16} sm={24}>
          <Card>
            <Form form={form} onSubmit={this.handleSubmit}>
              <FormItem
                labelCol={{ span: 4 }}
                wrapperCol={{ span: 12 }}
                label="分类名"
                extra="这将是它在站点上显示的名字。"
              >
                <Input
                  v-decorator={[
                    'name',
                    { rules: [{ required: true, message: '请输入分类名' }] }
                  ]}
                />
              </FormItem>

              <FormItem
                labelCol={{ span: 4 }}
                wrapperCol={{ span: 12 }}
                label="别名"
                extra="“别名”是在URL中使用的别称，它可以令URL更美观。通常使用小写，只能包含字母，数字和连字符（-）。"
              >
                <Input v-decorator={[
                  'slug'
                ]}
                />
              </FormItem>

              <FormItem
                labelCol={{ span: 4 }}
                wrapperCol={{ span: 12 }}
                label="描述"
                extra="标签描述"
              >
                <Input
                  v-decorator={[
                    'description'
                  ]}
                  type="textarea"
                  autosize={{ minRows: 3, maxRows: 6 }}
                />
              </FormItem>

              <FormItem
                wrapperCol={{
                  xs: { span: 24, offset: 0 },
                  sm: { span: 12, offset: 4 }
                }}
              >
                <Button type="primary" htmlType="submit">
                  { this.id ? '编辑' : '创建' }
                </Button>
              </FormItem>
            </Form>
          </Card>
        </Col>

        <Col md={8} sm={12}>
          <Card>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
          </Card>
        </Col>
      </Row>
    )
  }
}
</script>
