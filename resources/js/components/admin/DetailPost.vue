<template>
	<div class="bg-white p-4">
		<div v-if="loading" class="text-center mt-4">
			<font-awesome icon="spinner" spin size="3x" class="text-primary" />
		</div>
		<div v-else>
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-9">
					<h1 class="m-0">{{ content.title }}</h1>
					<small>{{ dateFill(content.date_post) }}</small>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-3">
					<div class="row">
						<div class="col-9 pt-2 text-right">
							<p>{{ content.name }}</p>
						</div>
						<div class="col-3 pl-0">
							<img class="rounded-circle" :src="content.avatar || sauce+'/img/default.png'" width="40" height="40">
						</div>
					</div>
				</div>
			</div>
			<hr/>
			<markdown-it-vue class="md-body" :content="desc" />
			<hr class="my-4 pb-4" />
			<h4>Komentar</h4>
			<div v-for="r in reply.data">
				<div class="float-right">
					<button class="btn btn-danger" title="Hapus komentar" @click="openDel(r.reply_id)">
						<font-awesome icon="trash"/>
					</button>
				</div>
				<p :class="r.role ? 'text-success' : 'text-primary'"><img class="img-fluid rounded-circle" :src="r.avatar || sauce+'/img/default.png'" width="40" height="40" /> {{ r.name }} | {{ dateFill(r.date_reply) }}</p>
				<markdown-it-vue class="md-body" :content="r.reply" />
				<hr/>
			</div>
			<laravel-vue-pagination :data="reply" @pagination-change-page="changePage"></laravel-vue-pagination>
		</div>
		<div id="post-del" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-danger text-light">
						<h5><font-awesome icon="exclamation-triangle" /> Konfirmasi hapus</h5>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Apakah anda yakin menghapus komentar ini?
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

<script>
	export default{
		data: () => ({
			loading: true,
			content: {},
			desc: '',
			reply: {},
			sauce: process.env.MIX_APP_URL,
			id: 0
		}),
		mounted(){
			axios.post(`/get-post/${this.$route.params.id}`)
				.then(resp => {
					this.content = resp.data.post
					this.reply = resp.data.reply
					this.desc = this.content.desc
					this.loading = false
				})
				.catch(err => console.error(err))
		},
		methods: {
			dateFill(date){
				var d = new Date(date)
				return d.toLocaleString('id-ID', {dateStyle: 'medium', timeStyle: 'short'})
			},
			changePage(page = 1){
				axios.post(`/get-post/${this.$route.params.id}?page=`+page)
					.then(resp => this.reply = resp.data.reply)
					.catch(err => console.error(err))
			},
			openDel(id){
				this.id = id
				$('#post-del').modal()
			},
			del(){
				axios.delete(`/reply-delete/${this.id}/${this.$route.params.id}`)
					.then(resp => {
						this.reply = resp.data
						$('#post-del').modal('hide')
					}).catch(err => console.error(err))
			}
		}
	}
</script>