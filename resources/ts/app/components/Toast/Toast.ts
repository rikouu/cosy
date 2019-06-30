
import Vue, { ComponentOptions } from 'vue'
import Main from './index.vue'

let ToastConstructor = Vue.extend(Main)
export function Toast (message: String, type = 'success', time = 2000) {
  const options = {
    message: message,
    time: time,
    type: type
  }
  const toast = new ToastConstructor({
    data: options
  } as ComponentOptions<Vue>)
  toast.$mount()
  document.body.appendChild(toast.$el)
}
