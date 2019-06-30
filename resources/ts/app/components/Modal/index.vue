<template>
  <div>
    <div v-if="show" class="cosy-tips" :class="tipClass.concat(sizeClass)">
      <div class="cosy-tips-overlay" :style="maskStyle" @click="handleClose"></div>
      <div class="cosy-tips-body">
        <div class="cosy-tips-content">
          <slot/>
        </div>
        <div class="btn-close-tips" @click="handleClose">
          <svg
            t="1553064665406"
            class="icon w-32"
            style
            viewBox="0 0 1024 1024"
            version="1.1"
            xmlns="http://www.w3.org/2000/svg"
            p-id="3368"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            width="200"
            height="200"
          >
            <path
              d="M512 12C235.9 12 12 235.9 12 512s223.9 500 500 500 500-223.9 500-500S788.1 12 512 12z m166.3 609.7c15.6 15.6 15.6 40.9 0 56.6-7.8 7.8-18 11.7-28.3 11.7s-20.5-3.9-28.3-11.7L512 568.6 402.3 678.3c-7.8 7.8-18 11.7-28.3 11.7s-20.5-3.9-28.3-11.7c-15.6-15.6-15.6-40.9 0-56.6L455.4 512 345.7 402.3c-15.6-15.6-15.6-40.9 0-56.6 15.6-15.6 40.9-15.6 56.6 0L512 455.4l109.7-109.7c15.6-15.6 40.9-15.6 56.6 0 15.6 15.6 15.6 40.9 0 56.6L568.6 512l109.7 109.7z"
              p-id="3369"
            ></path>
          </svg>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Prop, Watch } from 'vue-property-decorator'

@Component({})
export default class Modal extends Vue {
  @Prop({
    type: String,
    default: () => {
      return 'full'
    }
  })
  public size?: string;

  protected maskStyle: object = {};

  protected tipClass: Array<string> = [''];

  @Prop({ type: Boolean, default: false })
  public show: Boolean = false;

  @Watch('show')
  onShowChanged (val: Boolean, oldVal: Boolean) {
    if (val === true) {
      document.body.classList.add('modal-open')
      this.tipClass.push('cosy-tips-open')
    }
  }

  protected get sizeClass () {
    const classList: Array<string> = []
    const classMap: { [index: string]: any } = {
      big: 'cosy-tips-lg',
      'no-padding': 'cosy-tips-nopd',
      cover: 'cosy-tips-cover cosy-tips-nopd',
      full: 'cosy-tips-xl',
      small: 'cosy-tips-sm'
    }

    if (this.size && classMap[this.size!] !== undefined) {
      classList.push(classMap[this.size!])
    }
    return classList
  }

  public mounted () {
    console.log(this.$el.classList.remove('d-none'))
  }

  public handleClose () {
    document.body.classList.remove('modal-open')
    this.tipClass.splice(
      this.tipClass.indexOf('cosy-tips-open'),
      1,
      'cosy-tips-close'
    )
    setTimeout(() => {
      this.tipClass.splice(this.tipClass.indexOf('cosy-tips-close'), 1)
      this.$emit('update:show', false)
    }, 120)
  }
}
</script>

<style lang="less" scoped>
@import "./index";
</style>
