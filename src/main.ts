import { createApp } from "vue";
import App from "./App.vue";
import { router } from "@/plugins/router";
import store from "./assets/store";
import loadingMixin from "./assets/TS/loadingmixins";

// import "./assets/main.css";
import "@/assets/scss/main.scss";

const app = createApp(App);

app.mixin(loadingMixin); // Ajoutez le mixin ici

app.use(store).use(router).mount("#app");
