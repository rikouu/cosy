<template>
  <div>
    <a-form :form="form" @submit="handleSubmit">
      <a-form-item>
        <a-input
          v-decorator="[
            'username',
            {
              rules: [
                { required: true, message: '用户名不能为空' }
              ],
              validateTrigger: ['change', 'blur']
            }
          ]"
          placeholder="用户名或邮箱"
          size="large"
        >
          <template v-slot:prefix>
            <a-icon type="mail" style="color:rgba(0,0,0,.25)" />
          </template>
        </a-input>
      </a-form-item>
      <a-form-item>
        <a-input
          v-decorator="[
            'password',
            {
              rules: [
                { required: true, message: '密码不能为空' }
              ],
              validateTrigger: ['change', 'blur']
            }
          ]"
          placeholder="密码"
          size="large"
          type="password"
        >
          <template v-slot:prefix>
            <a-icon type="lock" style="color:rgba(0,0,0,.25)" />
          </template>
        </a-input>
      </a-form-item>
      <div>
        <a-form-item style="margin-bottom: 0px; margin-top: -12px">
          <a-checkbox v-decorator="[ 'remember_me' ]">记住我</a-checkbox>
          <a style="float: right;" href="#">忘记密码</a>
        </a-form-item>
        <a-form-item>
          <a-button
            :loading="submitting"
            size="large"
            type="primary"
            htmlType="submit"
            class="submit"
          >登录</a-button>
        </a-form-item>
        <slot />
      </div>
    </a-form>
  </div>
</template>

<script>
import { Button, Checkbox, Form, Icon, Input } from 'ant-design-vue'
import axios from 'axios'
import { setFiledsWithErrors } from '@/utils/form'

export default {
  name: 'Login',
  components: {
    AButton: Button,
    AInput: Input,
    AIcon: Icon,
    AForm: Form,
    AFormItem: Form.Item,
    ACheckbox: Checkbox
  },
  props: {
    action: {
      type: String,
      required: true
    },
    method: {
      type: String,
      default: 'get'
    }
  },
  data () {
    return {
      submitting: false,
      form: this.$form.createForm(this)
    }
  },
  methods: {
    handleSubmit (e) {
      e.preventDefault()
      this.form.validateFields((err, values) => {
        if (!err) {
          this.submitting = true
          return axios
            .post(location.href, values)
            .then(res => {
              this.submitting = false
              const data = res.data
              if (data.welcome) {
                this.$notification.success({
                  message: '欢迎',
                  description: data.welcome
                })
                setTimeout(() => {
                  location.href = '/'
                }, 1000)
              }
            })
            .catch(err => {
              this.submitting = false
              setFiledsWithErrors(this.form, err)
            })
        }
      })
    }
  }
}
</script>
