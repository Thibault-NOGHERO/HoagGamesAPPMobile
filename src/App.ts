import { ref, onMounted, onUnmounted, computed } from "vue";
import ovalDiv from "@/assets/decoFiles/ovalDiv.vue";

const windowWidth = ref(window.innerWidth);

const onResize = () => {
  windowWidth.value = window.innerWidth;
};

onMounted(() => {
  window.addEventListener("resize", onResize);
});

onUnmounted(() => {
  window.removeEventListener("resize", onResize);
});

const ovalDivCount = computed(() => (windowWidth.value > 600 ? 2 : 1));

const getClassForOvalDiv = (index: number) => {
  const positionClass =
    windowWidth.value > 600 ? "position-" + (index + 1) : "";
  const parityClass = index % 2 === 0 ? "left" : "right";
  return `${positionClass} ${parityClass}`;
};

export default {
  components: {
    ovalDiv,
  },
  setup() {
    return {
      ovalDivCount,
      getClassForOvalDiv,
    };
  },
};
