<template>
  <div class="background-color">
    <ovalDiv
      v-for="index in ovalDivCount"
      :key="index"
      :class="getClassForOvalDiv(index)"
    ></ovalDiv>
  </div>
  <header></header>

  <RouterView></RouterView>

  <main></main>
  <footer></footer>
</template>

<script lang="ts" src="./App.ts"></script>
