<template>
  <div class="login">
    <form @submit.prevent="login">
      <input type="text" v-model="username" placeholder="Username">
      <input type="password" v-model="password" placeholder="Password">
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  name: 'Login',
  data() {
    return {
      username: '',
      password: ''
    }
  },
  methods: {
    ...mapActions(['login']),
    login() {
      this.login({ username: this.username, password: this.password })
    }
  }
}
</script>

<style scoped>
.login form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
</style>
