<template>
	<div class="bg-white p-4">
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
			<div v-if="$auth.user().id === r.id_user" class="float-right">
				<button class="btn" :class="$auth.user().role === 1 ? 'btn-success' : 'btn-primary'" @click="openEdit(r.reply, r.reply_id)">Edit komentar</button>
				<button class="btn btn-danger" @click="confirmDel(r.reply_id)">Hapus komentar</button>
			</div>
			<p><img class="img-fluid rounded-circle" :src="r.avatar || sauce+'/img/default.png'" width="40" height="40" /> {{ r.name }} | {{ dateFill(r.date_reply) }}</p>
			<markdown-it-vue class="md-body" :content="r.reply" />
			<hr/>
		</div>
		<laravel-vue-pagination :data="reply" @pagination-change-page="changePage"></laravel-vue-pagination>
		<div v-if="$auth.check()" class="form-group">
			<textarea class="form-control" placeholder="Isi komentar.. *Bisa menggunakan format tambahan" style="height: 100px" v-model="replyTxt"></textarea>
			<button class="mt-2 btn" :class="$auth.user().role === 1 ? 'btn-success' : 'btn-primary'" @click.prevent="sendReply">Kirim komentar</button>
		</div>
		<div v-else class="text-center">
			<h1><router-link class="text-decoration-none" to="/login">Login</router-link> untuk menambah komentar</h1>
			<p>Tidak punya akun? <router-link class="text-decoration-none" to="/register">Daftar disini</router-link></p>
		</div>
		<div v-if="$auth.check()" id="post-del" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-danger text-light">
						<h5>Konfirmasi hapus</h5>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Yakin hapus komentar ini?
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-dismiss="modal">Tidak</button>
						<button class="btn btn-danger" @click.prevent="del">Ya</button>
					</div>
				</div>
			</div>
		</div>
		<div v-if="$auth.check()" id="edit-reply" class="modal fade" tabindex="-1">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Edit komentar</h5>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<textarea class="form-control" placeholder="Isi komentar.. *Bisa menggunakan format tambahan" style="height: 250px" v-model="editReply"></textarea>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
						<button class="btn" :class="$auth.user().role === 1 ? 'btn-success' : 'btn-primary'" @click.prevent="editSend">Update komentar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data: () => ({
			content: {},
			reply: {},
			desc: '',
			replyTxt: '',
			editReply: '',
			replyId: 0,
			sauce: process.env.MIX_APP_URL
		}),
		mounted(){
			axios.post(`/get-post/${this.$route.params.id}`)
				.then(resp => {
					this.content = resp.data.post
					this.reply = resp.data.reply
					this.desc = this.content.desc
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
			sendReply(){
				if(this.replyTxt != '')
					axios.post(`/get-post/${this.$route.params.id}/send-reply/${this.$auth.user().id}`, {reply: this.replyTxt})
						.then(resp => {
							this.reply = resp.data
							this.replyTxt = ''
						})
						.catch(err => console.error(err))
			},
			openEdit(desc, id){
				this.replyId = id
				this.editReply = desc
				$('#edit-reply').modal()
			},
			editSend(){
				axios.post(`/reply-update/${this.replyId}/${this.$route.params.id}`, {reply: this.editReply})
					.then(resp => {
						this.reply = resp.data
						$('#edit-reply').modal('hide')
					}).catch(err => console.error(err))
			},
			confirmDel(id){
				$('#post-del').modal()
				this.replyId = id
			},
			del(){
				axios.delete(`/reply-delete/${this.replyId}/${this.$route.params.id}`)
					.then(resp => {
						this.reply = resp.data
						$('#post-del').modal('hide')
					}).catch(err => console.error(err))
			}
		}
	}
</script>