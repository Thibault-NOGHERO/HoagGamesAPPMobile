import { createRouter, createWebHistory } from "vue-router";
import NotFoundView from "@/app/views/TheNotFoundView.vue";
import appRoutes from "@/app/routes";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    ...appRoutes,

    {
      path: "/:pathMatch(.*)*",
      name: "not-found",
      component: NotFoundView,
    },
  ],
});
