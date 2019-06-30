import Vue from 'vue'
import VueI18n from 'vue-i18n'
import Storage from '@/utils/storage'
import { DEFAULT_LOCALE } from '@/store/mutation-types'

// zh-CN
import zhCNAntd from 'ant-design-vue/lib/locale-provider/zh_CN'
import zhCNLocale from './zh-CN'

Vue.use(VueI18n)

const messages = {
  zh_CN: {
    ...zhCNLocale,
    ...zhCNAntd
  }
}

const i18n = new VueI18n({
  locale: Storage.get(DEFAULT_LOCALE, 'zh_CN'),
  messages
})

export default i18n
