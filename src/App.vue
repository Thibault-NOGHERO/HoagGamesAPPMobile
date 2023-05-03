<template>
  <TheDeco></TheDeco>
  <header></header>

  <router-view v-if="!isLoading" />
  <Chargement v-else />

  <main></main>
  <footer></footer>
</template>

<script setup lang="ts">
import { useStore } from "vuex";
import Chargement from "@/assets/LoadingView.vue";

const store = useStore();
const isLoading = store.state.isLoading;
</script>
