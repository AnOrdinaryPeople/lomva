<template>
	<div class="bg-white p-4">
		<div v-if="checkProfile" class="row">
			<div class="col-3 overflow-auto" style="height: 100vh">
				<input class="form-control mb-2" type="text" :placeholder="$auth.user().role ? 'cari murid..' : 'cari guru..'" v-model="sQuery">
				<div v-for="(t, key) in list" class="card mb-2" @click="openChat(t.id, key)">
					<div class="card-body">
						<div class="row">
							<div class="col-2 p-0 text-right">
								<img class="img-fluid rounded-circle" width="50" height="50" :src="t.avatar || sauce+'/img/default.png'">
							</div>
							<div class="col">
								<p class="p-0 m-0">{{ t.name }}
									<!-- <small v-if="t.total > 0" class="badge" :class="$auth.user().role ? 'btn-success' :'btn-primary'">{{ t.total }}</small> --></p>
								<small class="text-muted">{{ t.school }}</small>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div v-if="selected" class="col-9">
				<div class="overflow-auto mb-2" style="height: 100vh">
					<div v-for="m in msg">
						<p v-if="m.user_id === $auth.user().id"><img class="img-fluid rounded-circle" width="40" height="40" :src="$auth.user().avatar || sauce+'/img/default.png'" /> {{ $auth.user().name }} <small class="text-muted">{{ m.created_at }}</small></p>
						<p v-else><img class="img-fluid rounded-circle" width="40" height="40" :src="select.avatar || sauce+'/img/default.png'" /> {{ select.name }} <small class="text-muted">{{ m.created_at }}</small></p>
						<p>{{ m.msg }}</p>
						<hr/>
					</div>
				</div>
				<form @submit.prevent="send">
					<div class="input-group">
						<input class="form-control" type="text" v-model="msgChat">
						<div class="input-group-append">
							<button id="btn-chat" class="btn" :class="$auth.user().role ? 'btn-success' : 'btn-primary'">Kirim</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div v-else class="text-center">
			<h1>Lengkapi data profil sebelum mulai chat</h1>
			<h4>Minimal nama sekolah sudah diisi</h4>
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
			teacher: [],
			msg: [],
			select: {
				avatar: '',
				name: ''
			},
			selected: false,
			sQuery: '',
			msgChat: '',
			id: 0,
			key: 0,
			checkProfile: true,
			sauce: process.env.MIX_APP_URL
		}),
		mounted(){
			axios.post(`/check-profile/${this.$auth.user().id}`)
				.then(resp => {
					if(resp.data.result)
						this.checkProfile = false
					else axios.post(`/chat/list/${this.$auth.user().id}/${this.$auth.user().role}`)
						.then(resp => this.teacher = resp.data)
						.catch(err => console.error(err))
				})
				.catch(err => console.error(err))
		},
		methods: {
			openChat(id, key){
				this.selected = true
				this.select = {
					avatar: this.teacher[key].avatar,
					name: this.teacher[key].name
				}
				this.id = id
				this.key = key
				axios.post(`/chat/open/${id}/${this.$auth.user().id}`)
					.then(resp => {
						this.msg = []

						for(var i = 0; i < resp.data.receive.length; i++)
							this.msg.push(resp.data.receive[i])
						for(var i = 0; i < resp.data.sender.length; i++)
							this.msg.push(resp.data.sender[i])

						this.msg.sort((a, b) => a.id > b.id ? 1 : -1)
					})
					.catch(err => console.error(err))
			},
			send(){
				if(this.msgChat != ''){
					var id = document.getElementById('btn-chat')

					id.setAttribute('disabled', 1)
					axios.post(`/chat/send/${this.$auth.user().id}/${this.id}`, {msg: this.msgChat})
						.then(() => {
							this.msgChat = ''
							this.openChat(this.id, this.key)
							id.removeAttribute('disabled')
						})
						.catch(err => {
							console.error(err)
							id.removeAttribute('disabled')
						})
				}
			}
		},
		computed: {
			list(){
				let filter = this.teacher

				if(this.sQuery)
					filter = this.teacher.filter(e => e.name.toLowerCase().indexOf(this.sQuery.toLowerCase()) > -1)

				return filter
			}
		}
	}
</script>