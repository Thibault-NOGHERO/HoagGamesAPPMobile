<template>
  <div class="background-color TheDeco">
    <ovalDiv
      v-for="index in ovalDivIndices"
      :key="index"
      :class="getClassForOvalDiv(index)"
      :style="getPosition(index)"
    ></ovalDiv>
  </div>
</template>

<script lang="ts">
import { ref, onMounted, onUnmounted, watchEffect } from "vue";
import ovalDiv from "@/assets/decoFiles/ovalDiv.vue";

export default {
  components: {
    ovalDiv,
  },
  props: {
    ovalDivCount: {
      type: Number,
      default: 4,
    },
  },
  setup(props) {
    const windowWidth = ref(window.innerWidth);
    const windowHeight = ref(window.innerHeight);

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

    const getOvalDivSettings = () => {
      let count = props.ovalDivCount;

      if (windowWidth.value >= 1000) {
        count += 1;
      }

      return count;
    };

    const ovalDivIndices = ref<number[]>([]);

    const updateOvalDivIndices = () => {
      const count = getOvalDivSettings();
      ovalDivIndices.value = Array.from({ length: count }, (_, i) => i);
    };

    onMounted(() => {
      updateOvalDivIndices();
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

    watchEffect(() => {
      updateOvalDivIndices();
    });

    const getClassForOvalDiv = (index: number) => {
      if (windowWidth.value >= 1000) {
        if (index >= ovalDivIndices.value.length - 2) {
          return "centerOval";
        }
      }

      const positionClass = windowHeight.value > 600 ? "position-" + index : "";
      const parityClass = index % 2 === 0 ? "rightOval" : "leftOval";

      return `${positionClass} ${parityClass}`;
    };

    const calculateTopPosition = (index: number) => {
      const ovalDivClass = getClassForOvalDiv(index);

      if (ovalDivClass.includes("right")) {
        return index * 300;
      } else if (ovalDivClass.includes("left")) {
        return index * 400;
      } else if (ovalDivClass.includes("centerOval")) {
        const centerIndex = index - (ovalDivIndices.value.length - 2);
        return centerIndex * 350;
      }
    };

    const calculateLeftPosition = (index: number) => {
      const ovalDivClass = getClassForOvalDiv(index);

      if (ovalDivClass.includes("centerOval")) {
        return (windowWidth.value - 300) / 2;
      } else {
        return "";
      }
    };

    const getPosition = (index: number) => {
      const top = calculateTopPosition(index);
      const left = calculateLeftPosition(index);

      return {
        top: `${top}px`,
        left: `${left}px`,
      };
    };

    return {
      ovalDivIndices,
      getClassForOvalDiv,
      getPosition,
    };
  },
};
</script>
