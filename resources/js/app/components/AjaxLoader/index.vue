<template>
  <nav>
    <div class="col-12 col-md-6">
      <div v-if="loading" class="ajax-loading">
        <span class="dot1"></span>
        <span class="dot2"></span>
      </div>
      <button
        v-else
        @click="loadMore"
        :disabled="disabled"
        class="dposts-ajax-load btn btn-light btn-block"
      >{{ disabled ? '没有更多内容' : '加载更多...' }}</button>
    </div>
  </nav>
</template>

<script>
import axios from 'axios'

function isElementInViewport (el) {
  const rect = el.getBoundingClientRect()
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <=
      (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  )
}

function givenElementInViewport (el, fn) {
  return function () {
    if (isElementInViewport(el)) {
      fn()
    }
  }
}

function addViewportEvent (el, fn) {
  if (window.addEventListener) {
    addEventListener('DOMContentLoaded', givenElementInViewport(el, fn), false)
    addEventListener('load', givenElementInViewport(el, fn), false)
    addEventListener('scroll', givenElementInViewport(el, fn), false)
    addEventListener('resize', givenElementInViewport(el, fn), false)
  }
}

export default {

  name: 'AjaxLoader',

  data () {
    return {
      loading: false,
      query: {},
      disabled: false
    }
  },

  created () {
    this.query = this.parseQuery()
    this.query.page = Number(this.query.page | 1)
  },

  mounted () {
    const that = this
    addViewportEvent(this.$el, function () {
      if (that.loading === false) {
        if (that.query.page <= 3) {
          that.loadMore()
        }
      }
    })
  },

  methods: {

    parseQuery () {
      const query = {}
      try {
        const search = location.search ? location.search.substring(1) : ''
        const regQuery = /([^&=]+)=([\w\W]*?)(&|$|#)/g
        let result
        while ((result = regQuery.exec(search)) != null) {
          query[result[1]] = result[2]
        }
      } catch (e) {}
      return query
    },

    loadMore () {
      this.loading = true
      const query = Object.assign({}, this.query)
      query.page = query.page + 1
      query.isAjax = true
      const idx = location.href.indexOf('?')
      const url =
      idx !== -1
        ? location.href.substr(0, location.href.indexOf('?'))
        : location.href
      axios
        .get(url, {
          params: query
        })
        .then(res => {
          const data = res.data
          this.query = query
          if (data.trim()) {
            const articles = document.querySelector('#articles')
            if (articles !== null) {
              let addDiv = document.createElement('div')
              addDiv.innerHTML = data
              const childNodes = addDiv.children
              Array.from(childNodes).forEach(function (node) {
                articles.appendChild(node)
              })
            }
          } else {
            this.disabled = true
          }
          this.loading = false
        })
        .catch(error => {
          console.log(error)
          this.loading = false
        })
    }
  }
}
</script>
