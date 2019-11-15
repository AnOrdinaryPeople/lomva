<template>
	<div class="bg-white p-4">
		<div class="row mb-2">
			<div class="col-6 pr-1">
				<form @submit.prevent="search">
					<div class="input-group">
						<input class="form-control" type="text" v-model="query" placeholder="Cari postingan / nama pembuat..">
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
					<th>Nama Pembuat</th>
					<th>Jenis Postingan</th>
					<th>Judul Postingan</th>
					<th>Isi Postingan</th>
					<th colspan="2" class="text-center">Tindakan</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="d in data.data">
					<td>{{ d.name }}</td>
					<td>{{ d.type ? 'Khusus guru BK' : 'Umum' }}</td>
					<td>{{ d.title }}</td>
					<td>{{ regexDesc(d.desc) }}</td>
					<td>
						<router-link class="btn btn-primary btn-block" title="Detail" :to="'/post-list/'+d.i">
							<font-awesome icon="eye" />
						</router-link>
					</td>
					<td>
						<button class="btn btn-danger btn-block" title="Hapus" @click="openDel(d.i, d.title)">
							<font-awesome icon="trash" />
						</button>
					</td>
				</tr>
			</tbody>
		</table>
		<laravel-vue-pagination :data="data" @pagination-change-page="changePage"></laravel-vue-pagination>
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
						Apakah anda yakin hapus postingan {{ ttl }}?
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-dismiss="modal">Tidak</button>
						<button id="del-btn" class="btn btn-danger" @click.prevent="del">Ya</button>
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
			data: {},
			loading: true,
			sauce: '',
			id: 0,
			ttl: '',
			query: ''
		}),
		mounted(){
			this.sauce = '/admin/post'
			this.getPost()
		},
		methods: {
			getPost(){
				axios.post(this.sauce)
					.then(resp => {
						this.data = resp.data
						this.loading = false
					})
					.catch(err => console.error(err))
			},
			changePage(page = 1){
				axios.post(this.sauce+'?page='+page, {query: this.query})
					.then(resp => this.data = resp.data)
					.catch(err => console.error(err))
			},
			regexDesc(desc){
				var d = desc.replace(/\[([^])*\]/, '')
					.replace(/\(([^])*\)/, '')
					.replace(/[#*_~>\`]/g, '')

				return desc.length > 50 ? desc.substring(0, 50)+'....' : d
			},
			openDel(id, title){
				this.id = id
				this.ttl = title
				$('#post-del').modal()
			},
			del(){
				var i = document.getElementById('del-btn')

				i.setAttribute('disabled', 1)
				$('#icon-del-loader').show()

				axios.delete('/my-post/delete/'+this.id)
					.then(() => {
						this.getPost()
						i.removeAttribute('disabled')
						$('#icon-del-loader').hide()
						$('#post-del').modal('hide')
					})
					.catch(err => {
						console.error(err)
						i.removeAttribute('disabled')
						$('#icon-del-loader').hide()
					}) 
			},
			search(){
				if(this.query != ''){
					var id = document.getElementById('search-btn')
					this.sauce = '/admin/post/search'

					id.setAttribute('disabled', 1)
					$('#icon-btn').hide()
					$('#icon-search-loader').show()

					axios.post(this.sauce, {query: this.query})
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
				}else this.getPost()
			}
		}
	}
</script>