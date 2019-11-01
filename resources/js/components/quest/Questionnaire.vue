<template>
	<div class="bg-white p-4">
		<div class="input-group col-sm-12 col-md-12 col-lg-6 mb-4 p-0">
			<input class="form-control" type="text" placeholder="Cari kuesioner / pembuat kuesioner" v-model="searchQuest">
			<div class="input-group-append">
				<button class="btn btn-primary" @click="searchQ">Cari</button>
			</div>
		</div>
		<div v-if="content.total > 0">
			<div v-for="c in content.data" class="card mb-4" @click="toQuest(c.quest_id)">
				<div class="card-body">
					<div class="row">
						<div class="col-8">
							<h1>{{ c.title }}</h1>
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
			searchQuest: '',
			content: { total: 1 },
			sauce: process.env.MIX_APP_URL,
			url: ''
		}),
		mounted(){
			const q = this.$route.query.q
			this.url = q ? '/questionnaire/search' : '/questionnaire/all-quest'

			if(q) axios.post(this.url, {search: q})
				.then(resp => this.content = resp.data)
				.catch(err => console.error(err))
			else axios.post(this.url)
				.then(resp => this.content = resp.data)
				.catch(err => console.error(err))
		},
		methods: {
			searchQ(){
				this.$router.push({ path: '/questionnaire?q='+this.searchQuest })
			},
			changePage(page = 1){
				axios.post(this.url+'?page='+page)
					.then(resp => this.content = resp.data)
					.catch(err => console.error(err))
			},
			toQuest(id){
				this.$router.push({ path:'/questionnaire/'+id })
			}
		},
		watch: {
			$route(to){
				axios.post(this.url, {search: this.$route.query.q})
					.then(resp => this.content = resp.data)
					.catch(err => console.error(err))
			}
		}
	}
</script>