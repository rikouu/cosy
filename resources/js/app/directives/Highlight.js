
import Prism from 'prismjs'

require('prismjs/components/prism-json')
require('prismjs/components/prism-css')
require('prismjs/components/prism-javascript')
require('prismjs/components/prism-less')
require('prismjs/components/prism-sass')
require('prismjs/components/prism-php')
require('prismjs/components/prism-markup')
require('prismjs/components/prism-markup-templating')
require('prismjs/components/prism-bash')

const highlightDirective = {
  bind: (el, binding, vnode, oldVnode) => {
    let blocks = el.querySelectorAll('pre code')
    blocks.forEach((block) => {
      Prism.highlightElement(block)
    })
  }
}

export default highlightDirective
