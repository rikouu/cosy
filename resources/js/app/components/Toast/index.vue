<template>
  <section
    :class="['cosy-tips', {
      'tips-success': type === 'success',
      'tips-error': type === 'error',
    }, 'cosy-tips-sm', tipClass]"
  >
    <div class="cosy-tips-overlay"></div>
    <div class="cosy-tips-body text-center">
      <div class="cosy-tips-content px-5">
        <template v-if="type === 'success'">
          <span class="d-block h1 text-success mb-2">
            <svg
              t="1553065772988"
              class="icon w-56"
              style
              viewBox="0 0 1024 1024"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              p-id="2922"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              width="200"
              height="200"
            >
              <defs />
              <path
                d="M666.272 472.288l-175.616 192a31.904 31.904 0 0 1-23.616 10.4h-0.192a32 32 0 0 1-23.68-10.688l-85.728-96a32 32 0 1 1 47.744-42.624l62.144 69.6 151.712-165.888a32 32 0 1 1 47.232 43.2m-154.24-344.32C300.224 128 128 300.32 128 512c0 211.776 172.224 384 384 384 211.68 0 384-172.224 384-384 0-211.68-172.32-384-384-384"
                p-id="2923"
              />
            </svg>
          </span>
        </template>

        <template v-else>
          <span class="d-block h1 text-danger mb-2">
            <svg
              t="1553065784656"
              class="icon w-56"
              style
              viewBox="0 0 1024 1024"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              p-id="3053"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              width="200"
              height="200"
            >
              <defs />
              <path
                d="M544 576a32 32 0 0 1-64 0v-256a32 32 0 0 1 64 0v256z m-32 160a32 32 0 1 1 0-64 32 32 0 0 1 0 64z m0-608C300.256 128 128 300.256 128 512s172.256 384 384 384 384-172.256 384-384S723.744 128 512 128z"
                p-id="3054"
              />
            </svg>
          </span>
        </template>
        <p class="text-md">{{message }}</p>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Toast',
  data () {
    return {
      message: '',
      type: 'success',
      time: 2000,
      tipClass: 'cosy-tips-open'
    }
  },
  created () {
    this.tipClass = 'cosy-tips-open'
  },
  mounted () {
    document.body.classList.add('modal-open')
    setTimeout(() => {
      document.body.classList.remove('modal-open')
      this.tipClass = 'cosy-tips-close'
      setTimeout(() => {
        this.tipClass = ''
        setTimeout(() => {
          this.$el.remove()
        }, 200)
      }, 400)
    }, this.time)
  }
}
</script>

<style lang="less" scoped>
@import "./index";
</style>
