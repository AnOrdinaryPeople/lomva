<template>
	<div class="bg-white p-4">
		<form @submit.prevent="searchQ">
			<div class="input-group col-sm-12 col-md-12 col-lg-6 mb-2 p-0">
				<input class="form-control" type="text" placeholder="Cari kuesioner / pembuat kuesioner" v-model="searchQuest">
				<div class="input-group-append">
					<button class="btn btn-primary"><font-awesome icon="search" /></button>
				</div>
			</div>
		</form>
		<select class="form-control mb-4 col-sm-6 col-md-6 col-lg-3" v-model="category">
			<option value="" disabled>-- Jenis kuesioner --</option>
			<option value="all">Semua jenis</option>
			<option value="1">Akademik</option>
			<option value="2">Karir</option>
			<option value="3">Sosial</option>
			<option value="4">Pribadi</option>
		</select>
		<div v-if="loader" class="text-center">
			<font-awesome icon="spinner" spin size="3x" class="text-primary" />
		</div>
		<div v-else>
			<div v-if="content.total > 0">
				<div v-for="c in list" class="card mb-4 shadow-sm" @click="toQuest(c.quest_id)">
					<div class="card-body">
						<div class="row">
							<div class="col-8">
								<h1>{{ c.title }}</h1>
								<small class="text-secondary">Jenis kuesioner <strong>{{ ctg(c.category) }}</strong></small>
							</div>
							<div class="col-4 text-right">
								<p>{{ c.name }} <img class="img-fluid rounded-circle" width="40" height="40" :src="c.avatar || sauce+'/img/default.png'"></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div v-else>
				<h1 class="text-center">Kuesioner tidak ditemukan</h1>
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
			searchQuest: '',
			content: { total: 1 },
			sauce: process.env.MIX_APP_URL,
			url: '',
			category: 0,
			loader: true
		}),
		mounted(){
			const q = this.$route.query.q
			this.url = q ? '/questionnaire/search/' : '/questionnaire/all-quest/'

			if(q) axios.post(this.url, {search: q})
				.then(resp => {
					this.content = resp.data
					this.loader = false
				})
				.catch(err => console.error(err))
			else axios.post(this.url)
				.then(resp => {
					this.content = resp.data
					this.loader = false
				})
				.catch(err => console.error(err.response))
		},
		methods: {
			searchQ(){
				if(this.searchQuest != '')
					this.$router.push({ path: '/questionnaire?q='+this.searchQuest })
			},
			changePage(page = 1){
				axios.post(this.url+'?page='+page)
					.then(resp => this.content = resp.data)
					.catch(err => console.error(err))
			},
			toQuest(id){
				this.$router.push({ path:'/questionnaire/'+id })
			},
			ctg(c){
				return c === 1 ? 'Akademik'
					: (c === 2 ? 'Karir' : (c === 3 ? 'Sosial' : 'Pribadi'))
			}
		},
		computed: {
			list(){
				let filter = this.content.data

				if(this.category === 'all') return this.content.data
				else if(this.category !== 'all' && this.category > 0)
					filter = this.content.data.filter(e => e.category == this.category)

				return filter
			}
		},
		watch: {
			$route(to){
				const q = this.$route.query.q
				this.url = q ? '/questionnaire/search/' : '/questionnaire/all-quest/'

				axios.post(this.url, {search: this.$route.query.q})
					.then(resp => {
						this.content = resp.data
						this.loader = false
					})
					.catch(err => console.error(err))
			}
		}
	}
</script>