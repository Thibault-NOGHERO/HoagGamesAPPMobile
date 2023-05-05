import { createRouter, createWebHistory } from "vue-router";
import NotFoundView from "@/app/views/TheNotFoundView.vue";
import appRoutes from "@/app/routes";
import SplashScreenRoutes from "@/SpashScreen/routes";
import userRoutes from "@/user/routes";

export const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes: [
    ...appRoutes,
    ...SplashScreenRoutes,
    ...userRoutes,

    {
      path: "/:pathMatch(.*)*",
      name: "not-found",
      component: NotFoundView,
    },
  ],
});
