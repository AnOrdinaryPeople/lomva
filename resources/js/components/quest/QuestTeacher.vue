<template>
	<div class="bg-white p-4">
		<router-link class="btn btn-success mb-4" to="/teacher/questionnaire/create"><font-awesome icon="plus" /> Buat kuesioner baru</router-link>
		<laravel-vue-pagination :data="content" @pagination-change-page="changePage"></laravel-vue-pagination>
		<div v-if="total > 0">
			<div v-for="c in content.data" class="card mb-4">
				<div class="card-header">
					<router-link class="btn btn-primary" :to="`/teacher/questionnaire/${c.id}/done`"><font-awesome icon="eye" /> Lihat hasil akhir</router-link>
					<button class="btn btn-danger" @click="openDel(c.id, c.title)"><font-awesome icon="trash" /> Hapus kuesioner</button>
				</div>
				<div class="card-body" @click="$router.push({path: `/teacher/questionnaire/${c.id}/edit`})">
					<h1>{{ c.title }}</h1>
				</div>
			</div>
		</div>
		<div v-else>
			<h1 class="text-center">Tidak ada kuesioner</h1>
		</div>
		<laravel-vue-pagination :data="content" @pagination-change-page="changePage"></laravel-vue-pagination>
		<div id="confirm-del" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-danger text-light">
						<h5>Konfirmasi hapus</h5>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Yakin hapus kuesioner {{ titleModal }}?
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-dismiss="modal">Tidak</button>
						<button class="btn btn-danger" @click.prevent="del">Ya</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style scoped>
	.card-body{ transition: all .3s ease }
	.card-body:hover{ opacity: .5;cursor: pointer }
</style>

<script>
	export default{
		data: () => ({
			content: {0:{title:''}},
			total: 1,
			idModal: 0,
			titleModal: ''
		}),
		mounted(){
			this.refresh()
		},
		methods: {
			changePage(page = 1){
				axios.post('/quest/teacher/'+this.$auth.user().id+'?page='+page)
					.then(resp => this.content = resp.data)
					.catch(err => console.error(err))
			},
			openDel(id, ttl){
				this.idModal = id
				this.titleModal = ttl
				$('#confirm-del').modal()
			},
			del(){
				axios.delete(`/quest/teacher/${this.idModal}/destroy`)
					.then(() => {
						this.refresh()
						$('#confirm-del').modal('hide')
					})
					.catch(err => console.error(err))
			},
			refresh(){
				axios.post('/quest/teacher/'+this.$auth.user().id)
					.then(resp => {
						this.content = resp.data
						this.total = resp.data.total
					})
					.catch(err => console.error(err))
			}
		}
	}
</script>