import { createRouter, createWebHistory } from "vue-router";
import NotFoundView from "@/app/views/TheNotFoundView.vue";
import appRoutes from "@/app/routes";
import SplashScreenRoutes from "@/SpashScreen/routes";

export const router = createRouter({
  history: createWebHistory(),
  routes: [
    ...appRoutes,
    ...SplashScreenRoutes,

    {
      path: "/:pathMatch(.*)*",
      name: "not-found",
      component: NotFoundView,
    },
  ],
});
