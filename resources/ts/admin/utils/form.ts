import { WrappedFormUtils, Field } from 'ant-design-vue/types/form/form'

export function setFiledsWithErrors (form: WrappedFormUtils, errors: { [index: string]: any }) {
  const filedValues: { [index: string]: any } = Object.assign({}, (<any>form).getFieldsValue())
  const fields: Field = {}
  Object.keys(filedValues).forEach(key => {
    fields[key] = {
      value: filedValues[key],
      errors: errors.hasOwnProperty(key) ? errors[key].map((msg: string) => {
        return new Error(msg)
      }) : undefined
    }
  })
  form.setFields(fields)
}
