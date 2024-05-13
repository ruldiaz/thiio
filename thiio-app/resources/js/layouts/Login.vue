<template>
  <v-container>
    <v-layout row justify-center>
      <v-flex xs12 sm8 md4>
        <v-card class="elevation-12">
          <v-toolbar dark color="primary">
            <v-toolbar-title>Login</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form @submit.prevent="login">
              <v-text-field v-model="email" label="Email" type="email" required></v-text-field>
              <v-text-field v-model="password" label="Password" type="password" required></v-text-field>
              <v-btn color="primary" type="submit">Login</v-btn>
            </v-form>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    login() {
      // You can perform login logic here, like sending the email and password to your server
      console.log('Email:', this.email);
      console.log('Password:', this.password);
      // Once you've authenticated, you can redirect the user to another page
      // For example, using Vue Router:
      // this.$router.push('/dashboard');
    }
  }
};
</script>

<style scoped>
.v-container {
  margin-top: 100px;
}
</style>
