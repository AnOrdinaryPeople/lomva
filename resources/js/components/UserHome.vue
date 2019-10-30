<template>
	<div>
		<laravel-vue-pagination :data="content" @pagination-change-page="changePage"></laravel-vue-pagination>
		<div v-if="content.total > 0">
			<div v-for="c in content.data" class="card mb-4" @click="goTo(c.toId)">
				<div class="card-body">
					<h1>{{ c.title }}</h1>
					<small>Dibuat oleh <strong>{{ c.name }}</strong> | {{ dateFill(c.date_post) }}</small>
				</div>
			</div>
		</div>
		<div v-else class="text-center">
			<h1>Hasil <i>{{ $route.query.q }}</i> tidak ditemukan</h1>
			<h4>Silahkan coba cari lagi</h4>
		</div>
		<laravel-vue-pagination :data="content" @pagination-change-page="changePage"></laravel-vue-pagination>
	</div>
</template>

<style scoped>
	.card{ transition: all .3s ease }
	.card:hover{ opacity: .5;cursor: pointer }
</style>

<script>
	import LaravelVuePagination from 'laravel-vue-pagination'

	export default{
		components: {
			LaravelVuePagination
		},
		data: () => ({
			content: {total: 1},
			sauce: ''
		}),
		mounted(){
			const q = this.$route.query.q
			this.sauce = this.$auth.user().role === 1 ? '/all-post/with-bk' : '/all-post/public'

			if(q) axios.post('/post-search', {search: q, role: this.$auth.user().role || 0})
				.then(resp => this.content = resp.data)
				.catch(err => console.error(err))
			else axios.post(this.sauce)
				.then(resp => this.content = resp.data)
				.catch(err => console.error(err))
		},
		methods: {
			goTo(id){
				this.$router.push({ path: '/post/'+id })
			},
			changePage(page = 1){
				axios.post(this.sauce+'?page='+page)
					.then(resp => this.content = resp.data)
					.catch(err => console.error(err))
			},
			dateFill(date){
				var d = new Date(date)
				return d.getDate()+'-'+(d.getMonth()+1)+'-'+d.getFullYear()
			}
		},
		watch: {
			$route(to){
				axios.post('/post-search', {search: this.$route.query.q, role: this.$auth.user().role || 0})
					.then(resp => this.content = resp.data)
					.catch(err => console.error(err))
			}
		}
	}
</script>