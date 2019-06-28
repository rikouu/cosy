<template>
  <nav>
    <slot/>
    <button class="dposts-ajax-load btn btn-light btn-block">Load more...</button>
  </nav>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import axios, { AxiosRequestConfig } from "axios";

function isElementInViewport(el: Element) {
  const rect = el.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <=
      (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}

function givenElementInViewport(el: Element, fn: any) {
  return function() {
    if (isElementInViewport(el)) {
      console.log("2222222");
      fn();
    }
  };
}

function addViewportEvent(el: Element, fn: any) {
  if (window.addEventListener) {
    addEventListener("DOMContentLoaded", givenElementInViewport(el, fn), false);
    addEventListener("load", givenElementInViewport(el, fn), false);
    addEventListener("scroll", givenElementInViewport(el, fn), false);
    addEventListener("resize", givenElementInViewport(el, fn), false);
  }
}

@Component({})
export default class AjaxLoader extends Vue {
  protected loading = false;

  protected page: Number = 1;

  protected parseQuery() {
    const query: { [index: string]: any } = {};
    try {
      const search = location.search ? location.search.substring(1) : "";
      var regQuery = /([^&=]+)=([\w\W]*?)(&|$|#)/g;
      let result = null;

      while ((result = regQuery.exec(search)) != null) {
        query[result[1]] = result[2];
      }
    } catch (e) {}
    return query;
  }

  protected loadMore() {
    const query = this.parseQuery();
    query.page = (query.page | 1) + 1;
    query.isAjax = true;
    console.log(query)
    this.loading = true;
    const idx = location.href.indexOf("?");
    const url = idx !== -1 ? location.href.substr(0, location.href.indexOf("?")) : location.href;
    axios
      .get(url, {
        params: query
      } as AxiosRequestConfig)
      .then(res => {
        const data = res.data;
        if (data.trim()) {
          const dataNode = document.createElement('div');
          dataNode.innerHTML = data
          document.write(data)
          console.log(dataNode);
          // document.getElementById('articles')!.append(dataNode.chi);
        } else {
          // this.noMore = true;
        }
        this.loading = false;
      })
      .catch(error => {
        this.loading = false;
      });
  }

  public mounted() {
    const that = this;
    addViewportEvent(this.$el, function() {
      if (false === that.loading) {
        that.loadMore();
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
    });
  }
}
</script>
