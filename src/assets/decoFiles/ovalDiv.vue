<template>
  <div class="some-class">test3</div>
</template>

<script setup lang="ts"></script>

<style lang="scss">
@import "@/assets/scss/_mixins.scss";

.some-class {
  @include backgroundOval;
}
</style>
