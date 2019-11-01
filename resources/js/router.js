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
import Questionnaire from './components/quest/Questionnaire'
import InfoQuest from './components/quest/InfoQuest'
import QuestTest from './components/quest/QuestTest'
import QuestTeacher from './components/quest/QuestTeacher'
import CreateQuest from './components/quest/CreateQuest'

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
			path: '/questionnaire',
			name: 'questionnaire',
			component: Questionnaire,
			meta: { auth: {
				roles: 0,
				redirect: '/dashborad'
			}}
		},{
			path: '/questionnaire/:id',
			name: 'info-quest',
			component: InfoQuest,
			meta: { auth: true }
		},{
			path: '/questionnaire/:id/test',
			name: 'quest-test',
			component: QuestTest,
			meta: { auth: true }
		},{
			path: '/teacher/questionnaire',
			name: 'teacher-quest',
			component: QuestTeacher,
			meta: { auth: {
				roles: 1,
				redirect: '/questionnaire'
			}}
		},{
			path: '/teacher/questionnaire/create',
			name: 'teacher-quest-create',
			component: CreateQuest,
			meta: { auth: {
				roles: 1,
				redirect: '/questionnaire'
			}}
		},{
			path: '/teacher/questionnaire/:id/edit',
			name: 'teacher-quest-edit',
			component: CreateQuest,
			meta: { auth: {
				roles: 1,
				redirect: '/questionnaire'
			}}
		},{
			path: '*',
			redirect: { name: 'home' }
		}
	]
})