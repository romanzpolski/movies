import 'es6-promise/auto'
import axios from 'axios'
import './bootstrap'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './Index'
import authConfig from './auth'
import router from './router'
import VueParticles from 'vue-particles'

// Set Vue globally
window.Vue = Vue

// Set Vue router
Vue.router = router
Vue.use(VueRouter)

// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
Vue.use(VueAuth, authConfig)

// Set VueParticles for 404 page
Vue.use(VueParticles)

// Load Index
Vue.component('index', Index)
const app = new Vue({
    el: '#app',
    router
});
