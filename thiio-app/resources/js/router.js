import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from './layouts/Dashboard.vue'; // Import your Dashboard component
import Login from "./layouts/Login.vue";

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard
  },
  // Add other routes here
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
