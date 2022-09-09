import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './pages/Home.vue'
import NotFound from "./pages/NotFound.vue";
import SingleApartment from "./pages/SingleApartment.vue";
import MessageResult from "./pages/MessageResult.vue";


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
        name: 'admin-home',
        props: { default:true},
        component: Home
    },
    {
      path: "/:slug",
      name: "single-apartment",
      component: SingleApartment,
    },
    {
      path: "/admin/:slug",
      name: "admin-single-apartment",
      component: SingleApartment,
    },
    {
      path: "/result",
      name: "message-result",
      component: MessageResult,
    },
    {
      path: "/*",
      name: "not-found",
      component: NotFound
    },
    {
      path: "/admin/*",
      name: "admin-not-found",
      component: NotFound
    },
  ]
});

export default router;