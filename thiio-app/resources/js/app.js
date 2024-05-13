import './bootstrap';
import { createApp } from "vue";
import app from "./layouts/app.vue";
import vuetify from "./vuetify";
import router from './router';

createApp(app).use(router).use(vuetify).mount("#app");
