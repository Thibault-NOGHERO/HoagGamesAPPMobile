<template>
  <div id="signup-form">
    <form @submit.prevent="signupProcess">
      <div class="hg-TheInscriptionView-element">
        <label for="pseudo">Pseudo : </label>

        <input
          type="text"
          v-model="formData.pseudo"
          id="pseudo"
          ref="inputRef"
          required
          class="hg-TheInscriptionView-input"
        />
      </div>

      <div class="hg-TheInscriptionView-element">
        <label for="email">Email:</label>
        <input
          type="email"
          v-model="formData.email"
          id="email"
          required
          class="hg-TheInscriptionView-input"
        />
      </div>
      <div class="hg-TheInscriptionView-element">
        <label for="password">Mot de passe:</label>
        <input
          type="password"
          v-model="formData.password"
          id="password"
          required
          class="hg-TheInscriptionView-input"
        />
      </div>
      <div class="hg-TheInscriptionView-element">
        <label for="password_confirm">Confirmer le mot de passe:</label>
        <input
          type="password"
          v-model="formData.password_confirm"
          id="password_confirm"
          required
          class="hg-TheInscriptionView-input"
        />
      </div>
      <div class="">
        <button type="submit" class="button" :disabled="!formIsValid">
          S'inscrire
        </button>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import axios from "axios";
import { ref, computed } from "vue";
import { Router, useRouter } from "vue-router";
import config from "@/plugins/config";

const formData = ref({
  pseudo: "",
  email: "",
  password: "",
  password_confirm: "",
});

const router: Router = useRouter();

const signupProcess = async () => {
  try {
    // const apiUrl = `${process.env.VUE_APP_BASE_URL}/${process.env.VUE_APP_URL_API}/signup_process.php`;
    const apiUrl = `${config.baseUrl}/${config.apiUrl}/signup_process.php`;
    const data = {
      pseudo: formData.value.pseudo,
      email: formData.value.email,
      password: formData.value.password,
      password_confirm: formData.value.password_confirm,
      // bio: "Je suis un nouvel utilisateur !", // Valeur par défaut pour bio
      // plateform: "Aucune plateforme ajoutée pour le moment.", // Valeur par défaut pour plateform
    };
    const response = await axios.post(apiUrl, data);
    console.log(response);
    router.push("/connexion");
  } catch (error) {
    console.log(error);
  }
};

const formIsValid = computed(() => {
  return (
    formData.value.pseudo &&
    formData.value.email &&
    formData.value.password &&
    formData.value.password_confirm &&
    formData.value.password === formData.value.password_confirm
  );
});
</script>

<style lang="scss">
.hg-TheInscriptionView {
  &-input {
    display: block;
    border-radius: 100px;
    border: 1px #999999 solid;
    padding: 16px 24px;
    width: 100%;

    > label {
      color: #aaaaaa;
      font-family: "Inter";
      font-style: normal;
      font-weight: 400;
      font-size: 20px;
      line-height: 24px;
    }
    > input {
      color: #aaaaaa;
      width: 100%;
    }
  }
  &-element {
    padding: 46px;
    display: flex;
    justify-content: center;
  }
}
</style>
