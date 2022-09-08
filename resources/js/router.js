import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './pages/Home.vue'
import NotFound from "./pages/NotFound.vue";
import SingleApartment from "./pages/SingleApartment.vue";


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
        path: '/admin',
        name: 'home',
        component: Home
    },
    {
      path: "/:slug",
      name: "single-apartment",
      component: SingleApartment,
    },
    {
      path: "/admin/:slug",
      name: "single-apartment",
      component: SingleApartment,
    },
    {
      path: "/*",
      name: "not-found",
      component: NotFound
    },
  ]
});

export default router;