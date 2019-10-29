<template>
	<div>
		<div v-if="counter > 0">
			<div v-for="c in content" class="card mb-4">
				<div class="card-header">
					<button class="btn btn-danger" @click="openModalDel(c.id, c.title)">Hapus postingan</button>
				</div>
				<div class="card-body" @click="goTo(c.id)">
					<h1>{{ c.title }}</h1>
				</div>
			</div>
		</div>
		<div v-else class="text-center">
			<h1>Tidak ada postingan</h1>
			<router-link to="/add-post">Buat postingan baru</router-link>
		</div>
		<div id="post-del" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-danger text-light">
						<h5>Konfirmasi hapus</h5>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Yakin hapus postingan {{ ttl }}?
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
			content: {},
			ttl : '',
			idDel: '',
			counter: 0
		}),
		mounted(){
			this.getMyPost()
		},
		methods: {
			goTo(id){
				this.$router.push({ path: '/my-post/'+id })
			},
			openModalDel(id, title){
				this.idDel = id
				this.ttl = title
				$('#post-del').modal()
			},
			del(){
				$('#post-del').modal('hide')
				axios.delete('/my-post/delete/'+this.idDel)
					.then(() => this.getMyPost())
					.catch(err => console.error(err))
			},
			getMyPost(){
				axios.post('/my-post/'+this.$auth.user().id)
					.then(resp => {
						this.counter = resp.data.total
						this.content = resp.data.data
					}).catch(err => console.error(err))
			}
		}
	}
</script>