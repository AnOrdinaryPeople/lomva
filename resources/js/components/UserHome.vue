<template>
	<div class="bg-white p-4">
		<div v-if="loader" class="text-center">
			<font-awesome icon="spinner" spin size="3x" class="text-primary" />
		</div>
		<div v-else>
			<laravel-vue-pagination :data="content" @pagination-change-page="changePage"></laravel-vue-pagination>
			<div v-if="content.total > 0">
				<div v-for="c in content.data" class="card mb-4 shadow" @click="goTo(c.toId)">
					<div class="card-body">
						<h1 class="text-bold">{{ c.title }}</h1>
						<p class="text-secondary">{{ regexDesc(c.desc) }}</p>
						<div class="row">
							<div class="col">
								<p>
									Dibuat oleh <strong :class="c.role ? 'text-success' : 'text-primary'">{{ c.name }}</strong> | {{ dateFill(c.date_post) }}<br/>
									<small v-if="c.type === 1" class="text-primary italic"><strong>khusus guru BK</strong></small>
								</p>
							</div>
							<div class="col">
								<div class="text-right">
									<p>Komentar ({{ c.total }})</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div v-else class="text-center">
				<h1>Hasil <i>{{ $route.query.q }}</i> tidak ditemukan</h1>
				<h4>Silahkan coba cari lagi</h4>
			</div>
			<laravel-vue-pagination :data="content" @pagination-change-page="changePage"></laravel-vue-pagination>
		</div>
	</div>
</template>

<style scoped>
	.card{ transition: all .3s ease }
	.card:hover{ opacity: .5;cursor: pointer }
</style>

<script>
	export default{
		data: () => ({
			content: {total: 1},
			sauce: '',
			loader: true
		}),
		mounted(){
			if(this.$auth.user().role === 2) this.$router.push({name: 'dashboard'})
			this.checkPath()
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
				return d.toLocaleString('id-ID', {dateStyle: 'medium'})
			},
			regexDesc(desc){
				var d = desc.replace(/\[([^])*\]/, '')
					.replace(/\(([^])*\)/, '')
					.replace(/[#*_~>\`]/g, '')

				return desc.length > 50 ? desc.substring(0, 50)+'....' : d
			},
			checkPath(){
				const q = this.$route.query.q
				this.sauce = this.$auth.user().role === 1 ? '/all-post/with-bk' : '/all-post/public'

				if(q) axios.post('/post-search', {search: q, role: this.$auth.user().role || 0})
					.then(resp => {
						this.content = resp.data
						this.loader = false
					})
					.catch(err => console.error(err))
				else axios.post(this.sauce)
					.then(resp => {
						this.content = resp.data
						this.loader = false
					})
					.catch(err => console.error(err))
			}
		},
		watch: {
			$route(to){
				this.checkPath()
			}
		}
	}
</script>