<template>
  <div :style="{
    marginTop: 20
  }">
    <slot/>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

@Component({})
export default class SideBar extends Vue {
  public mounted() {
    console.log(1);
    const sidebar = this.$el;
    console.log(sidebar);
    if (sidebar !== undefined) {
      // sidebar.theiaStickySidebar({
      //   additionalMarginTop: 20,
      //   additionalMarginBottom: 100
      // });
    }
  }
}
</script>

<style>
</style>
