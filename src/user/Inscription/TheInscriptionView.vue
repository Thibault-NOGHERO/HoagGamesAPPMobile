<template>
  <div id="inscription">
    <h1>Inscription</h1>
    <form @submit.prevent="submitForm">
      <div>
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" v-model="username" required />
      </div>
      <div>
        <label for="email">Email :</label>
        <input type="email" id="email" v-model="email" required />
      </div>
      <div>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" v-model="password" required />
      </div>
      <button type="submit">S'inscrire</button>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();

const username = ref("");
const email = ref("");
const password = ref("");

const statusMessage = ref("");

const submitForm = () => {
  const data = {
    username: username.value,
    email: email.value,
    password: password.value,
  };
  axios
    .post("${import.meta.env.VUE_APP_API_URL}/inscription.php", data)
    .then((response) => {
      // Mettre à jour le message d'état en fonction de la réponse
      statusMessage.value = response.data.message;
      // Rediriger l'utilisateur seulement si l'inscription est réussie
      if (response.data.success) {
        router.push("/connexion");
      }
    })
    .catch((error) => {
      // Afficher un message d'erreur si la requête a échoué
      console.error(error);
      statusMessage.value =
        "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
    });
};
</script>
