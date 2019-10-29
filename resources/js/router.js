import VueRouter from 'vue-router'

import Router from 'vue-router'
import Home from './components/Home'
import Register from './components/Register'
import Login from './components/Login'
import Profile from './components/Profile'
import AddPost from './components/AddPost'
import Guide from './components/Guide'
import UserHome from './components/UserHome'
import Post from './components/Post'
import MyPost from './components/MyPost'

export default new VueRouter({
	history: true,
	mode: 'history',
	linkExactActiveClass: 'active',
	routes: [
		{
			path: '/',
			name: 'home',
			component: Home
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
			path: '/dashboard',
			name: 'dashborad',
			component: UserHome
		},{
			path: '/profile',
			name: 'profile',
			component: Profile,
			meta: { auth: true }
		},{
			path: '/add-post',
			name: 'add-post',
			component: AddPost,
			meta: { auth: true }
		},{
			path: '/post/:id',
			name: 'post-user',
			component: Post
		},{
			path: '/my-post',
			name: 'my-post',
			component: MyPost,
			meta: { auth: true }
		},{
			path: '/my-post/:id',
			name: 'edit-my-post',
			component: AddPost,
			meta: { auth: true }
		},{
			path: '*',
			redirect: { name: 'home' }
		}
	]
})