<template>
  <div class="background-color TheDeco">
    <ovalDiv
      v-for="index in ovalDivCount"
      :key="index"
      :class="getClassForOvalDiv(index)"
    ></ovalDiv>
  </div>
</template>

<script lang="ts">
import { ref, onMounted, onUnmounted, computed } from "vue";
import ovalDiv from "@/assets/decoFiles/ovalDiv.vue";

export default {
  components: {
    ovalDiv,
  },
  setup() {
    const windowWidth = ref(window.innerWidth);
    const windowHeight = ref(window.innerHeight);
    const isLandscape = computed(() => windowWidth.value > windowHeight.value);

    const onResize = () => {
      windowWidth.value = window.innerWidth;
      windowHeight.value = window.innerHeight;
    };

    const resetWindowHeight = () => {
      windowHeight.value = window.innerHeight;
    };

    const resetWindowWidth = () => {
      windowWidth.value = window.innerWidth;
    };

    onMounted(() => {
      window.addEventListener("resize", onResize);
      window.addEventListener("orientationchange", onResize);
      document.addEventListener("DOMContentLoaded", onResize);
      window.addEventListener("orientationchange", resetWindowHeight);
      window.addEventListener("orientationchange", resetWindowWidth);
    });

    onUnmounted(() => {
      window.removeEventListener("resize", onResize);
      window.removeEventListener("orientationchange", onResize);
      document.removeEventListener("DOMContentLoaded", onResize);
      window.removeEventListener("orientationchange", resetWindowHeight);
      window.removeEventListener("orientationchange", resetWindowWidth);
    });

    const ovalDivCount = computed(() => (windowWidth.value > 600 ? 2 : 1));

    const getClassForOvalDiv = (index: number) => {
      const positionClass =
        windowWidth.value > 600 ? "position-" + (index + 1) : "";
      const parityClass = index % 2 === 0 ? "rightOval" : "leftOval";
      return `${positionClass} ${parityClass}`;
    };

    return {
      ovalDivCount,
      getClassForOvalDiv,
      isLandscape,
    };
  },
};
</script>

<style lang="scss">
.TheDeco {
  overflow-x: hidden;
}
</style>
