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

async function submitForm() {
  try {
    const response = await axios.post(
      `${import.meta.env.VUE_APP_API_URL}/inscription.php`,
      {
        username: username.value,
        email: email.value,
        password: password.value,
      }
    );

    console.log(response); // Ajouté pour voir la réponse dans la console

    if (response.data.success) {
      alert("Inscription réussie !");
      router.push("/connexion");
    } else {
      alert("Erreur lors de l'inscription : " + response.data.message);
    }
  } catch (error) {
    console.error(error);
    alert("Erreur lors de la connexion au serveur.");
  }
}
</script>
