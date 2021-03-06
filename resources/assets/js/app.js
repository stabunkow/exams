
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')
import jwt from './helpers/jwt'
window.jwt = jwt

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import VueRouter from 'vue-router'
import createRouter from './router/router'
import Vuex from 'vuex'
import createStore from './store/store'
import 'mint-ui/lib/style.css'
import MintUI from 'mint-ui'
import Octicon from 'vue-octicon'
import 'vue-octicon/icons'

import App from './app.vue'

Vue.use(VueRouter)
Vue.use(Vuex)
Vue.use(MintUI)
Vue.use(Octicon)

const router = createRouter()
const store = createStore()

const app = new Vue({
    router,
    store,
    render: (h) => h(App)
}).$mount('#app')
