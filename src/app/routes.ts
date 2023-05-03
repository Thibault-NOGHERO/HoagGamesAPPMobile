import HomeView from "@/app/views/TheHomeView.vue";
import Chargement from "@/assets/LoadingView.vue";

export default [
  {
    path: "/",
    component: HomeView,
  },
  {
    path: "/pause",
    name: "Pause",
    component: Chargement,
  },
];
