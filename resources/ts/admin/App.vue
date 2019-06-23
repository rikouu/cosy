<template>
  <div id="app">
    <BasicLayout>
      <router-view/>
    </BasicLayout>
  </div>
</template>

<script lang="tsx">
import { Component, Prop, Vue } from 'vue-property-decorator'
import BasicLayout from './components/BasicLayout/index.vue'

@Component({
  components: {
    BasicLayout
  }
})
export default class App extends Vue {

}

</script>

<style lang="less" scoped>

</style>
