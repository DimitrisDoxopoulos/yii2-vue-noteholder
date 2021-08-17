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
      <input type="pasword" v-model="form.password" placeholder="Your Password"><br>
      <input type="pasword" v-model="form.password_repea" placeholder="Repeat Password"><br>
      <button>Register</button>
      <router-link to="/login" class="link">Click here to Login</router-link>
    </form>
  </div>
</template>

<script>
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
}
</script>

<style scoped>

</style>