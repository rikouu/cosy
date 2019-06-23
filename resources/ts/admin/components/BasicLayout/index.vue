<template>
    <div>
        ss
        <slot/>
        ssd
    </div>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator'

@Component({})
export default class BasicLayout extends Vue {

}
</script>

<style lang="less" scoped>
@import "./index";
</style>
