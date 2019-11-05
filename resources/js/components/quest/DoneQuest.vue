<template>
	<div class="bg-white p-4">
		<button class="btn btn-success mb-4" data-toggle="modal" data-target="#result-score"><font-awesome :icon="['far', 'eye']" /> Lihat hasil kuesioner</button>
		<div v-for="c in content.data" class="card mb-4">
			<div class="card-body">
				<div class="row">
					<div class="col-10">
						<div class="row">
							<div class="col-1 p-0 text-right">
								<img class="img-fluid rounded-circle" width="50" height="50" :src="c.avatar">
							</div>
							<div class="col">
								<h1>{{ c.name }}</h1>
							</div>
						</div>
					</div>
					<div class="col-2">
						<h4>Total skor: {{ c.total_score }}</h4>
					</div>
				</div>
			</div>
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
	</div>
</template>

<script>
	export default{
		data: () => ({
			content: {},
			result: {},
			sauce: ''
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
			}
		}
	}
</script>