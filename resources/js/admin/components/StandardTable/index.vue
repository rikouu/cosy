<script>
import { Table } from 'ant-design-vue'
export default {
  name: 'StandardTable',
  methods: {
    handleTableChange () {

    }
  },
  render () {
    const { data, pagination, columns, name, loading } = this
    return (
      <Table
        columns={columns}
        // rowKey="record => record.login.uuid"
        dataSource={data}
        pagination={pagination}
        loading={loading}
        onChange={() => {}}
      >
        <template slot="name" slot-scope="name">
          { name.first } { name.last }
        </template>
      </Table>
    )
  }
}
</script>
