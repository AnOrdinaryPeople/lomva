<template>
	<div class="card">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link" href="#" :class="page === 0 ? 'active' : ''" @click.prevent="checker(0)">Input postingan</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#" :class="page === 1 ? 'active' : ''" @click.prevent="checker(1)">Lihat hasil isi postingan</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#" :class="page === 2 ? 'active' : ''" @click.prevent="checker(2)">Tambahan</a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div v-if="$auth.user().role === 1 && page === 0" class="form-group">
				<label>Jenis postingan</label>
				<div class="custom-control custom-radio">
					<input id="radio-public" class="custom-control-input" type="radio" v-model="type" value="0">
					<label class="custom-control-label" for="radio-public">Umum</label>
				</div>
				<div class="custom-control custom-radio">
					<input id="radio-bk" class="custom-control-input" type="radio" v-model="type" value="1">
					<label class="custom-control-label" for="radio-bk">Khusus guru BK</label>
				</div>
			</div>
			<div v-if="page === 0" class="form-group">
				<input class="form-control" page="text" v-model="title" placeholder="Judul postingan">
				<small v-if="errors.title" v-for="e in errors.title" class="text-danger">{{ e }}<br/></small>
			</div>
			<div v-if="page === 0" class="form-group">
				<textarea class="form-control mt-2" v-model="content" style="height: 450px" placeholder="Isi postingan"></textarea>
				<small v-if="errors.desc" v-for="e in errors.desc" class="text-danger">{{ e }}<br/></small>
			</div>
			<markdown-it-vue v-if="page === 1" class="md-body" :content="content" />
			<guide v-if="page === 2"></guide>
			<button id="btn-add-post" v-if="page === 0 || page === 1" class="btn" :class="$auth.user().role === 1 ? 'btn-success' : 'btn-primary'" @click="send">{{ btnTitle }}</button>
			<font-awesome icon="spinner" spin size="lg" class="text-primary" style="display: none" id="icon-loader" />
		</div>
	</div>
</template>

<script>
	export default{
		data: () => ({
			title: '',
			content: '',
			type: 0,
			page: 0,
			btnTitle: 'Tambah postingan',
			errors: {},
			id: 0,
			routeName: '',
			canLeave: false
		}),
		mounted(){
			this.routeName = this.$route.name
			this.checkPath()
		},
		methods: {
			checker(t){
				this.page = t
			},
			send(){
				var id = document.getElementById('btn-add-post')
				const req = {
					type: this.type,
					title: this.title,
					desc: this.content
				}, url = this.routeName == 'add-post' ? `/post-save/${this.$auth.user().id}` : '/post-update/'+this.id

				id.setAttribute('disabled', 1)
				$('#icon-loader').show()

				axios.post(url, req)
					.then(resp => {
						this.canLeave = true
						this.$router.push({path: resp.data.url})
						$('#icon-loader').hide()
						id.removeAttribute('disabled')
					})
					.catch(err => {
						this.errors = err.response.data.errors
						this.page = 0
						$('#icon-loader').hide()
						id.removeAttribute('disabled')
					})
			},
			checkPath(){
				if(this.routeName != 'add-post'){
					this.id = this.$route.params.id
					axios.post(`my-post/edit/${this.id}/${this.$auth.user().id}`)
						.then(resp => {
							if(resp.data.title === undefined) this.$router.push({path: '/add-post'})
							else{
								this.title = resp.data.title
								this.content = resp.data.desc
								this.type = resp.data.type
								this.btnTitle = 'Update postingan'
							}
						})
				}
			}
		},
		watch: {
			$route(to){
				this.routeName = to.name
				if(to.name == 'add-post'){
					this.title = ''
					this.content = ''
					this.type = 0
					this.btnTitle = 'Tambah postingan'
				}else if(to.name == 'edit-my-post') this.checkPath()
			}
		},
		beforeRouteLeave(to, from, next){
			if(this.canLeave) next()
			else if(this.title != '' || this.content != ''){
				if(window.confirm('Apakah kamu yakin ingin keluar dari halaman ini? hasil postingan kamu belum disimpan'))
					next()
				else next(false)
			}else next()
		}
	}
</script>