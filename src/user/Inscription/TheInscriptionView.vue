<template>
  <div id="signup-form">
    <form @submit.prevent="signupProcess">
      <div class="form-group">
        <label for="pseudo">Pseudo:</label>
        <input type="text" v-model="formData.pseudo" id="pseudo" required />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" v-model="formData.email" id="email" required />
      </div>
      <div class="form-group">
        <label for="password">Mot de passe:</label>
        <input
          type="password"
          v-model="formData.password"
          id="password"
          required
        />
      </div>
      <div class="form-group">
        <label for="password_confirm">Confirmer le mot de passe:</label>
        <input
          type="password"
          v-model="formData.password_confirm"
          id="password_confirm"
          required
        />
      </div>
      <div class="form-group">
        <button type="submit" class="button" :disabled="!formIsValid">
          S'inscrire
        </button>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import axios from "axios";
import { Router, useRouter } from "vue-router";

interface FormData {
  pseudo: string;
  email: string;
  password: string;
  password_confirm: string;
}

const formData: FormData = {
  pseudo: "",
  email: "",
  password: "",
  password_confirm: "",
};

const router: Router = useRouter();

// const signupProcess = () => {
//   axios
//     .post(
//       "http://localhost/testHoaggamesApp/API/try/sinup_process.php",
//       formData
//     )
//     .then((response) => {
//       console.log(response);
//       router.push("/connexion");
//     })
//     .catch((error) => {
//       console.log(error);
//     });
// };

const signupProcess = () => {
  axios({
    method: "post",
    url: "http://localhost/testHoaggamesApp/API/try/signup_process.php",
    data: {
      pseudo: "test",
      email: "test@test.com",
      password: "test",
      password_confirm: "test",
    },
  });
};
const formIsValid = () => {
  return (
    formData.pseudo &&
    formData.email &&
    formData.password &&
    formData.password_confirm &&
    formData.password === formData.password_confirm
  );
};
</script>
