<template>
  <div>
    <slot/>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import Prism from "prismjs";

require("prismjs/components/prism-json");
require("prismjs/components/prism-css");
require("prismjs/components/prism-javascript");
require("prismjs/components/prism-less");
require("prismjs/components/prism-sass");
require("prismjs/components/prism-php");
require("prismjs/components/prism-markup");
require("prismjs/components/prism-markup-templating");
require("prismjs/components/prism-bash");

@Component({})
export default class ArticleContent extends Vue {
  public mounted() {
    const blocks = this.$el.querySelectorAll("pre code");
    blocks.forEach(block => {
      Prism.highlightElement(block);
    });
  }
}
</script>

<style lang="less" scoped>
@import "./index";
</style>
