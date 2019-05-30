<template>
    <transition name="fade-in">
        <div
            v-if="visible"
            @click.stop="handleClick"
            :style="{
                'right': styleRight,
                'bottom': styleBottom
              }">
            <slot>
                Top
            </slot>
        </div>
    </transition>
</template>

<script>
  export default {

    name: 'BackTop',

    data() {
      return {
        visible: false,
        container: null,
        el: null,
      }
    },

    mounted() {
      this.init();
    },

    methods: {
      init() {
        this.container = document;
        this.el = document.documentElement;
      }
    }
  }
</script>

<style lang="less" scoped>

</style>
