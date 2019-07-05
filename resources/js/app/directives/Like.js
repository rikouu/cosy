
import axios from 'axios'

import { Toast } from '../components/Toast/Toast'

const likeDirective = {
  bind: (el, binding, vnode, oldVnode) => {
    el.addEventListener('click', function (e) {
      e.preventDefault()
      el.blur()
      const id = binding.value
      axios.post(`/article/${id}/like`)
        .then(res => {
          const { isLike, likesCount } = res.data
          document.querySelectorAll('a.post-like').forEach(item => {
            if (isLike) {
              item.classList.add('current')
            } else {
              item.classList.remove('current')
            }
          })
          document.querySelectorAll('.like-count').forEach(item => {
            item.innerHTML = likesCount
          })

          if (isLike) {
            Toast('谢谢点赞', 'success')
          } else {
            Toast('取消点赞', 'error')
          }
        })
        .catch(error => {
          Toast(error.message, 'error')
        })
    }, false)
  }
}

export default likeDirective
