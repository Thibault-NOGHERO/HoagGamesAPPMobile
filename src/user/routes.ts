import inscription from "@/user/Inscription/TheInscriptionView.vue";
import connexion from "@/user/Connexion/TheConnexionView.vue";

export default [
  {
    path: "/inscription",
    component: inscription,
  },
  {
    path: "/connexion",
    component: connexion,
  },
];
