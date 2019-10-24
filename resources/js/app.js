require('./bootstrap')

import App from './components/App.vue'
import auth from './auth.js'
import router from './router.js'

import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'

window.Vue = require('vue')

Vue.use(VueAxios, axios)
axios.defaults.baseURL = process.env.MIX_APP_URL+'/api'

Vue.router = router
Vue.use(VueRouter)

Vue.use(VueAuth, auth)


new Vue({
	router,
    render: h => h(App)
}).$mount('#app')
