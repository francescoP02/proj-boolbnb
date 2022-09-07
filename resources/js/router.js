import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './pages/Home.vue'
import NotFound from "./pages/NotFound.vue";
import SingleApartment from "./pages/SingleApartment.vue";
import ContactPage from "./pages/ContactPage.vue";

Vue.use(VueRouter)
const router = new VueRouter({
  mode: 'history',
  routes: [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
      path: "/:slug",
      name: "single-apartment",
      component: SingleApartment,
    },
    {
      path: "/:slug/contact",
      name: "contact-single-apartment",
      component: ContactPage,
    },
    {
      path: "/*",
      name: "not-found",
      component: NotFound
    },
  ]
});

export default router;