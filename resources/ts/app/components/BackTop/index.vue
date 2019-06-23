<template>
  <div @click.stop="scrollToTop" :class="{ active: active }">
    <slot/>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

@Component({})
export default class BackTop extends Vue {

  protected active: Boolean = false;

  protected scrollToTop() {
    let el = document.documentElement;
    let step = 0;
    let interval = setInterval(() => {
      if (el.scrollTop <= 0) {
        clearInterval(interval);
        return;
      }
      step += 10;
      el.scrollTop -= step;
    }, 20);
  }

  protected handleScroll() {
    const windowW =
      document.documentElement.clientWidth || document.body.clientWidth;
    const windowH =
      document.documentElement.clientHeight || document.body.clientHeight;
    const scrollTop =
      window.pageYOffset ||
      document.documentElement.scrollTop ||
      document.body.scrollTop;
    const startPoint = windowH / 2;

    const el = document.getElementsByClassName("fixed-top");
    if (el && el.length > 0) {
      if (scrollTop > 72) {
        el[0].classList.add("scroll");
      } else {
        el[0].classList.remove("scroll");
      }
    }
    this.active = scrollTop >= startPoint && windowW >= 1024;
  }

  public mounted() {
    window.addEventListener("scroll", this.handleScroll);
    this.handleScroll();
  }
}
</script>

<style>
</style>
