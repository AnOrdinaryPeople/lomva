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
import DoneQuest from './components/quest/DoneQuest'
import Chat from './components/Chat'
import Students from './components/Students'
import AboutUs from './components/AboutUs'
import Dashboard from './components/admin/Dashboard'
import TeacherList from './components/admin/TeacherList'
import StudentList from './components/admin/StudentList'
import UserPost from './components/admin/UserPost'
import Quest from './components/admin/Quest'
import DetailPost from './components/admin/DetailPost'
import DetailQuest from './components/admin/DetailQuest'

export default new VueRouter({
	history: true,
	mode: 'history',
	linkExactActiveClass: 'active',
	routes: [
		{
			path: '/',
			name: 'homepage',
			component: Home,
			alias: '/homepage'
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
			path: '/home',
			name: 'home',
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
				redirect: '/home'
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
			path: '/teacher/questionnaire/:id/done',
			name: 'teacher-quest-done',
			component: DoneQuest,
			meta: { auth: {
				roles: 1,
				redirect: '/questionnaire'
			}}
		},{
			path: '/students',
			name: 'students',
			component: Students,
			meta: { auth: {
				roles: 1,
				redirect: '/home'
			}}
		},{
			path: '/chat',
			name: 'chat',
			component: Chat,
			meta: { auth: true }
		},{
			path: '/about',
			name: 'about',
			component: AboutUs
		},{
			path: '/dashboard',
			name: 'dashboard',
			component: Dashboard,
			meta: { auth: {
				roles: 2,
				redirect: '/home'
			}}
		},{
			path: '/teacher-list',
			name: 'teacher-list',
			component: TeacherList,
			meta: { auth: {
				roles: 2,
				redirect: '/home'
			}}
		},{
			path: '/student-list',
			name: 'student-list',
			component: StudentList,
			meta: { auth: {
				roles: 2,
				redirect: '/home'
			}}
		},{
			path: '/post-list',
			name: 'post-list',
			component: UserPost,
			meta: { auth: {
				roles: 2,
				redirect: '/home'
			}}
		},{
			path: '/post-list/:id',
			name: 'post-list-detail',
			component: DetailPost,
			meta: { auth: {
				roles: 2,
				redirect: '/home'
			}}
		},{
			path: '/questionnaire-list',
			name: 'questionnaire-list',
			component: Quest,
			meta: { auth: {
				roles: 2,
				redirect: '/home'
			}}
		},{
			path: '/questionnaire-list/:id',
			name: 'questionnaire-list-detail',
			component: DetailQuest,
			meta: { auth: {
				roles: 2,
				redirect: '/home'
			}}
		},{
			path: '*',
			redirect: { name: 'homepage' }
		}
	]
})