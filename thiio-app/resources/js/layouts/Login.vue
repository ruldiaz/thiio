<template>
  <v-container fluid>
    <v-row align="center" justify="center" class="fill-height">
      <v-col cols="12" sm="10" md="4">
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
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    async login() {
      try {
        // Make an HTTP POST request to your backend endpoint
        const response = await axios.post('http://127.0.0.1:8000/api/login', {
          email: this.email,
          password: this.password
        });

        // Handle successful login response (e.g., store token, redirect, etc.)
        console.log('Login successful:', response.data);
        // Redirect user to dashboard or another page
        // this.$router.push('/dashboard');
      } catch (error) {
        // Handle login error (e.g., display error message)
        console.error('Login error:', error.response.data);
      }
    }
  }
};
</script>

<style scoped>
.v-container {
  margin-top: 100px;
  max-width: 1200px; /* Adjust the max-width here */
  width: 100%;
}
</style>
