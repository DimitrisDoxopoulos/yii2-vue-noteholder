<template>
  <div class="form-wrapper">
    <h3>Register and create notes</h3>
    <form @submit.prevent="register" action="">
      <div v-if="errors" class="errors">
        <p v-for="(error, field) in errors" :key="field">
          {{error[0]}}
        </p>
      </div>
      <input type="text" v-model="form.username" placeholder="Your Username"><br>
      <input type="password" v-model="form.password" placeholder="Your Password"><br>
      <input type="password" v-model="form.password_repeat" placeholder="Repeat Password"><br>
      <button>Register</button>
      <router-link to="/login" class="link">Click here to Login</router-link>
    </form>
  </div>
</template>

<script>
import authService from "../services/auth.service";

export default {
  name: "Registration",
  data() {
    return {
      form: {
        username: '',
        password: ''
      },
      errors: null
    }
  },
  methods : {
    async register() {
       const {success, errors} = await authService.register(this.form);
      if (success) {
        this.$router.push({name: 'home'});
      } else {
        this.errors = errors;
      }
    }
  }
}
</script>

<style scoped>

</style>