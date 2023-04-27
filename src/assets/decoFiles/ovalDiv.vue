<template>
  <div class="some-class">test3</div>
</template>

<script setup lang="ts"></script>

<style lang="scss">
@import "@/assets/scss/mixins";

.some-class {
  @include backgroundOval;
}
</style>
