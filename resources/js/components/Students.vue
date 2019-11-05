<template>
	<div class="bg-white p-4">
		<div v-for="(s, key) in student.data" class="card mb-2" @click="detailClick(key)">
			<div class="card-body">
				<div class="row">
					<div class="col-1 text-center">
						<img class="img-fluid rounded-circle" width="75" height="75" :src="s.avatar || sauce+'/img/default.png'" />
					</div>
					<div class="col-10">
						<h4>{{ s.name }}</h4>
						<p class="text-muted">{{ s.school }}</p>
					</div>
				</div>
			</div>
		</div>
		<laravel-vue-pagination :data="student" @pagination-change-page="changePage"></laravel-vue-pagination>
		<div id="detail-modal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Informasi Siswa</h5>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="border-bottom py-1 pr-4 text-center">
							<img class="img-fluid rounded-circle" width="100" height="100" :src="detail.avatar || sauce+'/img/default.png'" />
							<h2 class="mt-2">{{ detail.name }}</h2>
						</div>
						<div class="border-bottom py-1 pr-4">
							<h5>Email</h5>
							<p>{{ detail.email }}</p>
						</div>
						<div class="border-bottom py-1 pr-4">
							<h5>Sekolah</h5>
							<p>{{ detail.school }}</p>
						</div>
						<div class="border-bottom py-1 pr-4">
							<h5>No. Telepon</h5>
							<p>{{ detail.phone }}</p>
						</div>
						<div class="border-bottom py-1 pr-4">
							<h5>Jenis Kelamin</h5>
							<p>{{ detail.gender ? 'Laki-laki' : 'Perempuan' }}</p>
						</div>
						<div class="py-1 pr-4">
							<h5>Tanggal Lahir</h5>
							<p>{{ dateFill(detail.born) }}</p>
						</div>
					</div>
				</div>
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
			student: {},
			sauce: process.env.MIX_APP_URL,
			detail: {
				avatar: '',
				name: '',
				gender: 0,
				born: '',
				phone: '',
				email: '',
				school: ''
			}
		}),
		mounted(){
			axios.post('students')
				.then(resp => this.student = resp.data)
				.catch(err => console.error(err))
		},
		methods: {
			changePage(page = 1){
				axios.post('students?page='+page)
					.then(resp => this.student = resp.data)
					.catch(err => console.error(err))
			},
			detailClick(key){
				this.detail = this.student.data[key]
				console.log(this.student.data[key])
				$('#detail-modal').modal()
			},
			dateFill(date){
				var d = new Date(date)
				return d.toLocaleString('id-ID', {dateStyle: 'full'})
			}
		}
	}
</script>