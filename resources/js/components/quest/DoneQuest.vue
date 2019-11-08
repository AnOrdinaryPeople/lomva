<template>
	<div class="bg-white p-4">
		<button class="btn btn-success mb-4" data-toggle="modal" data-target="#result-score"><font-awesome :icon="['far', 'eye']" /> Lihat hasil kuesioner</button>
		<div v-if="content.total > 0">
			<div v-for="(c, key) in content.data" class="card mb-4" @click="openModal(c.done_id, key)">
				<div class="card-body">
					<div class="row">
						<div class="col-1 p-0 text-right">
							<img class="img-fluid rounded-circle" width="50" height="50" :src="c.avatar || img+'/img/default.png'" />
						</div>
						<div class="col">
							<h1>{{ c.name }}</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div v-else>
			<h1 class="text-center">Belum ada siswa yang mengerjakan kuesioner ini</h1>
		</div>
		<laravel-vue-pagination :data="content" @pagination-change-page="changePage"></laravel-vue-pagination>
		<div id="result-score" class="modal fade" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Hasil kuesioner</h5>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table">
							<tr>
								<th>Skor Terkecil</th>
								<th>Skor Terbesar</th>
								<th>Deskripsi</th>
							</tr>
							<tr v-for="r in result">
								<td>{{ r.min_score }}</td>
								<td>{{ r.max_score }}</td>
								<td>{{ r.desc }}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div id="detail-modal" class="modal fade" tabindex="-1">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Hasil kuesioner {{ name }}</h5>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table">
							<tr>
								<th>Selesai mengerjakan</th>
								<th>Hasil akhir</th>
							</tr>
							<tr v-for="(d, keyy) in detail">
								<td>{{ dateFill(d.created_at) }}</td>
								<td>{{ d.total_score }} <font-awesome :icon="status(keyy, true)" :class="status(keyy)" /> <span :class="status(keyy)">{{ status(keyy, false, true) }}</span></td>
							</tr>
						</table>
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
			result: {},
			sauce: '',
			img: process.env.MIX_APP_URL,
			detail: {},
			name: ''
		}),
		mounted(){
			this.sauce = `/quest/done/${this.$route.params.id}/${this.$auth.user().id}`

			axios.post(this.sauce)
				.then(resp => {
					this.content = resp.data.student
					this.result = resp.data.result
				})
				.catch(err => console.error(err))
		},
		methods: {
			changePage(page = 1){
				axios.post(this.suace+'?page='+page)
					.then(resp => this.content = resp.data)
					.catch(err => console.error(err))
			},
			openModal(id, key){
				axios.post(`quest/done/user/${this.$route.params.id}/${id}`)
					.then(resp => {
						console.log(resp.data)
						this.name = this.content.data[key].name
						this.detail = resp.data
						$('#detail-modal').modal()
					}).catch(err => console.error(err))
			},
			status(i, check = false, checker = false){
				var status = 'minus',
					clr = 'text-secondary',
					score = '',
					d = this.detail

				if(i !== 0 && d[i].total_score > d[i - 1].total_score){
					status = 'caret-up'
					clr = 'text-success'
					score = d[i].total_score - d[i - 1].total_score
				}else if(i !== 0 && d[i].total_score < d[i - 1].total_score){
					status = 'caret-down'
					clr = 'text-danger'
					score = d[i - 1].total_score - d[i].total_score
				}

				return check ? status : (checker ? score : clr)
			},
			dateFill(date){
				var d = new Date(date)
				return d.toLocaleString('id-ID', {dateStyle: 'medium', timeStyle: 'short'})
			}
		}
	}
</script>