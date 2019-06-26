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
    const scrollTop = el.scrollTop;
    let step = 0;
    const stepLength = Math.max(scrollTop / 512, 10);
    let interval = setInterval(() => {
      if (el.scrollTop <= 0) {
        clearInterval(interval);
      } else {
        step += stepLength;
        el.scrollTop -= step;
      }
    }, 20);
  }

  protected handleScroll() {
    const windowW =
      document.documentElement.clientWidth || document.body.clientWidth;
    const windowH =
      document.documentElement.clientHeight || document.body.clientHeight;
    const scrollTop =
      window.pageYOffset ||
      document.body.scrollTop ||
      document.documentElement.scrollTop;

    const startPoint = windowH / 3;

    const el = document.querySelector(".fixed-top");
    if (el !== null) {
      if (scrollTop > 72) {
        el.classList.add("scroll");
      } else {
        el.classList.remove("scroll");
      }
    }
    this.active = scrollTop >= startPoint && windowW >= 1024;
  }

  public created() {
    window.addEventListener("scroll", this.handleScroll);
    this.handleScroll();
  }

  public destroyed() {
    window.removeEventListener("scroll", this.handleScroll);
  }
}
</script>

<style lang="less" scoped>

.back-to-top {
  position: fixed;
  width: 48px;
  height: 48px;
  right: 25px;
  bottom: 25px;
  z-index: 1000;
  opacity: 0;
  visibility: hidden;
  cursor: pointer;
}

.back-to-top.active {
  opacity: 1;
  visibility: visible;
}

.back-to-top .icon-stack {
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  height: 100%;
  text-align: center;
  color: #fff;
  background-color: #010a13;
  overflow: hidden;
  transition: color 0.2s ease-in-out, background-color 0.2s ease-in-out,
    border-color 0.2s ease-in-out;
  border-radius: 4px;
}

.back-to-top .icon-stack:hover {
  background-color: #ff5d4a;
}

.back-to-top .icon-stack i {
  position: absolute;
  top: 9px;
  left: 50%;
  transform: translateX(-50%);
  transition: 0.15s ease 50ms;
}

.back-to-top .icon-stack .back-to-top-text {
  display: inline-block;
  transform: translateY(5px);
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  line-height: 1em;
  transition: transform 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.back-to-top .icon-stack:hover i {
  opacity: 0;
  transform: translateX(-50%) translateY(-10px);
  transition: all 0.45s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.back-to-top .icon-stack:hover .back-to-top-text {
  transform: translateY(0);
  transition: transform 0.25s cubic-bezier(0.165, 0.84, 0.44, 1) 50ms;
}
</style>
