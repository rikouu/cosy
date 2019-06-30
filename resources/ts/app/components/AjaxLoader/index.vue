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

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import axios, { AxiosRequestConfig } from 'axios'

function isElementInViewport (el: Element) {
  const rect = el.getBoundingClientRect()
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <=
      (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  )
}

function givenElementInViewport (el: Element, fn: any) {
  return function () {
    if (isElementInViewport(el)) {
      fn()
    }
  }
}

function addViewportEvent (el: Element, fn: any) {
  if (window.addEventListener) {
    addEventListener('DOMContentLoaded', givenElementInViewport(el, fn), false)
    addEventListener('load', givenElementInViewport(el, fn), false)
    addEventListener('scroll', givenElementInViewport(el, fn), false)
    addEventListener('resize', givenElementInViewport(el, fn), false)
  }
}

@Component({})
export default class AjaxLoader extends Vue {
  protected loading: boolean = false;

  protected query: any = {};

  protected disabled: boolean = false;

  public created () {
    this.query = this.parseQuery()
    this.query.page = Number(this.query.page | 1)
  }

  protected parseQuery () {
    const query: { [index: string]: any } = {}
    try {
      const search = location.search ? location.search.substring(1) : ''
      const regQuery = /([^&=]+)=([\w\W]*?)(&|$|#)/g
      let result
      while ((result = regQuery.exec(search)) != null) {
        query[result[1]] = result[2]
      }
    } catch (e) {}
    return query
  }

  protected loadMore () {
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
      } as AxiosRequestConfig)
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
        this.loading = false
      })
  }

  public mounted () {
    const that = this
    addViewportEvent(this.$el, function () {
      if (that.loading === false) {
        if (that.query.page > 3) {
          return
        }
        that.loadMore()
        // axios
        //   .post(location.href, param)
        //   .then(res => {
        //     const data = res.data;
        //     if (data.trim()) {
        //       this.page += 1;
        //       $("#articles").append(data);
        //     } else {
        //       this.noMore = true;
        //     }
        //     this.loading = false;
        //   })
        //   .catch(error => {
        //     this.loading = false;
        //   });
      }
    })
  }
}
</script>
