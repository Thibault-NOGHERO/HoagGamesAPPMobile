<template>
  <div class="hg-TitleSplashscreenView">
    <img
      src="@/assets/img/HGlogoSquare.png"
      alt="HGLogo"
      class="hg-TitleSplashscreenView-Logo"
    />
    <div class="hg-TitleSplashscreenView-Title">HOAG Games</div>
  </div>
</template>

<script setup lang="ts">
import { onMounted } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

onMounted(() => {
  setTimeout(() => {
    router.push("/destination"); // Remplacez '/destination' par la route souhaitée après le splashscreen
  }, 5000); // Ajustez la durée selon vos besoins
});
</script>

<style lang="scss">
.hg-TitleSplashscreenView {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  &-Logo {
    height: 50%;
  }
  &-Title {
    font-family: "Kanit", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 50px;
    line-height: 75px;

    color: rgba(187, 38, 73, 0.8);

    background: -webkit-linear-gradient(
      180deg,
      rgba(187, 38, 73, 0.8) 0%,
      rgba(187, 38, 73, 0.742169) 26.04%,
      rgba(187, 38, 73, 0) 86.46%
    );
    background: -moz-linear-gradient(
      180deg,
      rgba(187, 38, 73, 0.8) 0%,
      rgba(187, 38, 73, 0.742169) 26.04%,
      rgba(187, 38, 73, 0) 86.46%
    );
    background: -o-linear-gradient(
      180deg,
      rgba(187, 38, 73, 0.8) 0%,
      rgba(187, 38, 73, 0.742169) 26.04%,
      rgba(187, 38, 73, 0) 86.46%
    );
    background: -ms-linear-gradient(
      180deg,
      rgba(187, 38, 73, 0.8) 0%,
      rgba(187, 38, 73, 0.742169) 26.04%,
      rgba(187, 38, 73, 0) 86.46%
    );
    background: linear-gradient(
      180deg,
      rgba(187, 38, 73, 0.8) 0%,
      rgba(187, 38, 73, 0.742169) 26.04%,
      rgba(187, 38, 73, 0) 86.46%
    );

    -webkit-background-clip: text;
    -moz-background-clip: text;

    -webkit-text-fill-color: transparent;
    -moz-text-fill-color: transparent;

    background-clip: text;
  }
}
</style>
