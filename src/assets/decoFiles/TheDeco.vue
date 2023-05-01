<template>
  <div class="background-color TheDeco">
    <ovalDiv
      v-for="index in ovalDivCount"
      :key="index"
      :class="getClassForOvalDiv(index)"
      :style="getTopPosition(index)"
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

    const getOvalDivSettings = () => {
      let count;

      if (windowWidth.value > 900) {
        count = 4;
      } else if (windowWidth.value > 600) {
        count = 3;
      } else {
        count = 2;
      }

      return count;
    };

    const ovalDivCount = computed(() => getOvalDivSettings());

    const getClassForOvalDiv = (index: number) => {
      const positionClass =
        windowWidth.value > 600 ? "position-" + (index + 1) : "";
      const parityClass = index % 2 === 0 ? "rightOval" : "leftOval";
      return `${positionClass} ${parityClass}`;
    };

    const getTopPosition = (index: number) => {
      const mavariablecalculer = calculateTopPosition(index);

      return {
        top: `${mavariablecalculer}px`,
      };
    };

    const calculateTopPosition = (index: number) => {
      const ovalDivClass = getClassForOvalDiv(index);

      if (ovalDivClass.includes("right")) {
        return (index - 1) * 300;
      } else {
        return (index - 1) * 400;
      }
    };

    return {
      ovalDivCount,
      getClassForOvalDiv,
      isLandscape,
      getTopPosition,
    };
  },
};
</script>

<style lang="scss">
.TheDeco {
  overflow-x: hidden;
}
</style>
