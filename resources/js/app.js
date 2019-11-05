require('./bootstrap')

import App from './components/App.vue'
import auth from './auth.js'
import router from './router.js'

import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'

import LaravelVuePagination from 'laravel-vue-pagination'
import MarkdownItVue from 'markdown-it-vue'
import 'markdown-it-vue/dist/markdown-it-vue.css'
import Guide from './components/Guide'

import { library } from '@fortawesome/fontawesome-svg-core'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(fab, fas, far)

window.Vue = require('vue')

Vue.use(VueAxios, axios)
axios.defaults.baseURL = process.env.MIX_APP_URL+'/api'

Vue.router = router
Vue.use(VueRouter)

Vue.use(VueAuth, auth)

Vue.component('laravel-vue-pagination', LaravelVuePagination)
Vue.component('markdown-it-vue', MarkdownItVue)
Vue.component('guide', Guide)
Vue.component('font-awesome', FontAwesomeIcon)

new Vue({
	router,
    render: h => h(App)
}).$mount('#app')
