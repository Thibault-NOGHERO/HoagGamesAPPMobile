<template>
  <div class="background-color">
    <ovalDiv></ovalDiv>
  </div>
  <header></header>

  <RouterView></RouterView>

  <main></main>
  <footer></footer>
</template>

<script setup lang="ts">
import ovalDiv from "@/assets/decoFiles/ovalDiv.vue";
</script>
