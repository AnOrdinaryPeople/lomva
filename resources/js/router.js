import VueRouter from 'vue-router'

import Router from 'vue-router'
import Home from './components/Home'
import Register from './components/Register'
import Login from './components/Login'
import UserHome from './components/user/UserHome'
import TeacherHome from './components/teacher/TeacherHome'

export default new VueRouter({
	history: true,
	mode: 'history',
	linkExactActiveClass: 'active',
	routes: [
		{
			path: '/',
			name: 'home',
			component: Home,
			meta: { auth: false }
		},{
			path: '/register',
			name: 'register',
			component: Register,
			meta: { auth: false }
		},{
			path: '/login',
			name: 'login',
			component: Login,
			meta: { auth: false }
		},{
			path: '/home-user',
			name: 'home-user',
			component: UserHome,
			meta: { auth: {
				roles: 0,
				redirect: { name: 'home' }
			}}
		},{
			path: '/home-teacher',
			name: 'home-teacher',
			component: TeacherHome,
			meta: { auth: {
				roles: 1,
				redirect: { name: 'home' }
			}}
		},{
			path: '*',
			redirect: { name: 'home' }
		}
	]
})