<template>
	<div>
		<div v-for="c in content" class="card mb-4" @click="goTo(c.toId)">
			<div class="card-body">
				<h1>{{ c.title }}</h1>
				<small>Dibuat oleh <strong>{{ c.name }}</strong></small>
			</div>
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
			content: {}
		}),
		mounted(){
			const q = this.$route.query.q
			if(q) axios.post('/post-search', {search: q, role: this.$auth.user().role || 0})
				.then(resp => this.content = resp.data)
				.catch(err => console.error(err))
			else{
				if(this.$auth.user().role === 1) axios.post('/all-post/with-bk')
					.then(resp => this.content = resp.data)
					.catch(err => console.error(err))
				else axios.post('/all-post/public')
					.then(resp => this.content = resp.data)
					.catch(err => console.error(err))
			}
		},
		methods: {
			goTo(id){
				this.$router.push({ path: '/post/'+id })
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