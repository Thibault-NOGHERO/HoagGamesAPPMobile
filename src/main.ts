import { createApp } from "vue";
import App from "./App.vue";
import { router } from "@/plugins/router";

import "./assets/main.css";
import "@/assets/scss/main.scss";

createApp(App).use(router).mount("#app");
