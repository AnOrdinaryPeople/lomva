<template>
	<div class="bg-white p-4">
		<div class="row mb-2">
			<div class="col-6 pr-1">
				<form @submit.prevent="search">
					<div class="input-group">
						<input class="form-control" type="text" v-model="query" placeholder="Cari siswa / asal sekolah..">
						<div class="input-group-append">
							<button id="search-btn" class="btn btn-primary">
								<font-awesome icon="search" id="icon-btn" />
								<font-awesome icon="spinner" spin size="lg" style="display: none" id="icon-search-loader" />
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<laravel-vue-pagination :data="data" @pagination-change-page="changePage"></laravel-vue-pagination>
		<div v-if="loading" class="text-center mt-4">
			<font-awesome icon="spinner" spin size="3x" class="text-primary" />
		</div>
		<table v-else class="table table-striped">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Email</th>
					<th>Asal Sekolah</th>
					<th colspan="2" class="text-center">Tindakan</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(d, key) in data.data">
					<td>{{ d.name }}</td>
					<td>{{ d.email }}</td>
					<td>{{ d.school }}</td>
					<td>
						<button class="btn btn-primary btn-block" title="Edit" @click="openEdit(d.i, key)">
							<font-awesome icon="edit" />
						</button>
					</td>
					<td>
						<button class="btn btn-danger btn-block" title="Hapus" @click="openDel(d.i, key)">
							<font-awesome icon="trash" />
						</button>
					</td>
				</tr>
			</tbody>
		</table>
		<laravel-vue-pagination :data="data" @pagination-change-page="changePage"></laravel-vue-pagination>
		<div id="edit-modal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Edit {{ editName }}</h5>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="edit-name">Nama</label>
							<input id="edit-name" class="form-control" :class="val(errEdit.name || 0) ? 'is-invalid' : ''" type="text" v-model="edit.name">
							<small v-for="e in errEdit.name" class="text-danger">{{ e }}<br/></small>
						</div>
						<div class="form-group">
							<label for="edit-email">Email</label>
							<input id="edit-email" class="form-control" type="email" v-model="edit.email" disabled>
						</div>
						<div class="form-group">
							<label for="edit-password">Password (baru)</label>
							<input id="edit-password" class="form-control" :class="val(errEdit.password || 0) ? 'is-invalid' : ''" type="password" v-model="edit.password">
							<small v-for="e in errEdit.password" class="text-danger">{{ e }}<br/></small>
						</div>
						<div class="form-group">
							<label for="edit-school">Asal Sekolah</label>
							<input id="edit-school" class="form-control" :class="val(errEdit.school || 0) ? 'is-invalid' : ''" type="text" v-model="edit.school">
							<small v-for="e in errEdit.school" class="text-danger">{{ e }}<br/></small>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
						<button id="update-btn" class="btn btn-success" @click="update">Update</button>
						<font-awesome icon="spinner" spin size="lg" class="text-primary" style="display: none" id="icon-update-loader" />
					</div>
				</div>
			</div>
		</div>
		<div id="del-modal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-danger text-light">
						<h5><font-awesome icon="exclamation-triangle" /> Konfirmasi hapus</h5>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Apakah anda yakin mau menghapus {{ editName }}?<br></p>
						<p>
							<strong>PERINGATAN!</strong><br>
							Semua data seperti komentar, postingan, konsultasi, dan hasil kuesioner yang berhubungan dengan <strong>{{ editName }}</strong> benar-benar akan dihapus!
						</p>
						<div class="form-group">
							<label>Konfirmasi hapus dengan mengisi email {{ editName }}</label>
							<input class="form-control" type="text" v-model="emailDel" :placeholder="'email '+editName">
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
						<button id="delete-btn" class="btn btn-danger" @click="destroy" :disabled="emailDel !== compareDel">Hapus</button>
						<font-awesome icon="spinner" spin size="lg" class="text-primary" style="display: none" id="icon-del-loader" />
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data: () => ({
			query: '',
			src: '',
			data: {},
			edit: {
				name: '',
				email: '',
				school: '',
				password: ''
			},
			loading: true,
			errEdit: [],
			id: 0,
			editName: '',
			compareDel: '',
			emailDel: ''
		}),
		mounted(){
			this.src = '/admin/all/0'
			this.getStudent()
		},
		methods: {
			getStudent(){
				axios.post(this.src)
					.then(resp => {
						this.data = resp.data
						this.loading = false
					})
					.catch(err => console.error(err))
			},
			search(){
				if(this.query != ''){
					var id = this.getId('search-btn')
					this.src = '/admin/search/0'

					id.setAttribute('disabled', 1)
					$('#icon-btn').hide()
					$('#icon-search-loader').show()

					axios.post(this.src, {query: this.query})
						.then(resp => {
							this.data = resp.data
							$('#icon-search-loader').hide()
							$('#icon-btn').show()
							id.removeAttribute('disabled')
						})
						.catch(err => {
							console.error(err)
							$('#icon-search-loader').hide()
							$('#icon-btn').show()
							id.removeAttribute('disabled')
						})
				}else this.getStudent()
			},
			changePage(page = 1){
				axios.post(this.src+'?page='+page, {query: this.query})
					.then(resp => this.data = resp.data)
					.catch(err => console.error(err))
			},
			openEdit(id, key){
				this.id = id
				this.editName = this.data.data[key].name
				this.edit = JSON.parse(JSON.stringify(this.data.data[key]))
				$('#edit-modal').modal()
			},
			update(){
				var id = this.getId('update-btn')

				id.setAttribute('disabled', 1)
				$('#icon-update-loader').show()

				axios.post(`/admin/update/${this.id}`, this.edit)
					.then(resp => {
						this.getStudent()
						id.removeAttribute('disabled')
						$('#icon-update-loader').hide()
						$('#edit-modal').modal('hide')
					})
					.catch(err => {
						this.errEdit = err.response.data
						id.removeAttribute('disabled')
						$('#icon-update-loader').hide()
					})
			},
			openDel(id, key){
				this.id = id
				this.editName = this.data.data[key].name
				this.compareDel = this.data.data[key].email
				this.emailDel = ''
				$('#del-modal').modal()
			},
			destroy(){
				var id = this.getId('delete-btn')

				id.setAttribute('disabled', 1)
				$('#icon-del-loader').show()

				axios.delete(`/admin/delete/student/${this.id}`)
					.then(() => {
						this.getStudent()
						id.removeAttribute('disabled')
						$('#icon-del-loader').hide()
						$('#del-modal').modal('hide')
					}).catch(err => {
						console.error(err)
						id.removeAttribute('disabled')
						$('#icon-del-loader').hide()
					})
			},
			getId(id){
				return document.getElementById(id)
			},
			val(check){
				if(check !== 0 && check.length > 0) return true
				else return false
			}
		}
	}
</script>