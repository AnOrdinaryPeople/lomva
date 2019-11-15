<template>
	<div class="bg-white p-4">
		<div v-if="loading" class="text-center">
			<font-awesome icon="spinner" spin size="3x" class="text-primary" />
		</div>
		<div v-else>
			<div class="row">
				<div class="col-3 text-center">
					<h4>
						Jenis: {{ category === 1 ? 'Akademik' : (category === 2 ? 'Karir' : (category === 3 ? 'Sosial' : 'Pribadi')) }}
					</h4>
				</div>
				<div class="col-9">
					<h4>{{ title }}</h4>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-sm-12 col-md-12 col-lg-3 mt-2">
					<div class="btn-group w-100 mb-2">
						<button class="btn" :class="page === 1 ? 'btn-success' : 'btn-outline-success'" @click="page = 1">
							Tentang kuesioner
						</button>
						<button class="btn" :class="page === 2 ? 'btn-success' : 'btn-outline-success'" @click="page = 2">
							Hasil kuesioner
						</button>
					</div>
					<button class="btn btn-block" :class="page === 3 ? 'btn-success' : 'btn-outline-success'" @click="page = 3">
						Lihat semua pertanyaan
					</button>
					<hr/>
					<button v-for="n in countQuest(questions.length)" class="btn m-1"
						:class="i === n - 1 
							? (page === 0 ? 'btn-success' : 'btn-outline-success') 
							: 'btn-outline-success'" @click="toQuest(n)">{{ n }}</button>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-9 mt-2">
					<div v-if="page === 1">
						<markdown-it-vue class="md-body" :content="desc" />
					</div>
					<div v-else-if="page === 2">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Skor Terkecil</th>
									<th>Skor Terbesar</th>
									<th>Deskripsi</th>
								</tr>
							</thead>
							<tr v-for="r in results">
								<td>{{ r.min }}</td>
								<td>{{ r.max }}</td>
								<td>
									<button class="btn btn-primary" title="Deskripsi" @click="openResult(r.desc)">
										<font-awesome icon="eye" />
									</button>
								</td>
							</tr>
						</table>
					</div>
					<div v-else-if="page === 3">
						<div v-for="(q, qKey) in questions" class="input-group w-100 mb-2">
							<div class="input-group-prepend">
								<button class="btn btn-success" @click="toQuest(qKey + 1)">{{ qKey + 1 }}</button>
							</div>
							<input class="form-control bg-white" type="text" disabled="1" :value="q.question">
						</div>
					</div>
					<div v-else-if="page === 0">
						<small>Pertanyaan:</small>
						<p>{{ questions[i].question }}</p>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Jawaban</th>
									<th>Skor</th>
								</tr>
							</thead>
							<tr v-for="a in questions[i].answers">
								<td>{{ a.answer }}</td>
								<td>{{ a.score }}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div id="view-done" class="modal fade" tabindex="-1">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Deskripsi</h5>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<markdown-it-vue class="md-body" :content="doneDesc" />
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data: () => ({
			page: 1,
			category: 0,
			title: '',
			desc: '',
			questions: [],
			results: [],
			loading: true,
			i: 0,
			doneDesc: ''
		}),
		mounted(){
			axios.post('/admin/quest/get/'+this.$route.params.id)
				.then(resp => {
					var r = resp.data

					this.title = r.info.title
					this.desc = r.info.desc
					this.category = r.info.category
					this.questions = []
					this.results = []

					for(var i = 0; i < r.question.length; i++){
						var q = r.question[i]

						this.questions.push({
							question: q.question,
							answers: []
						})
						for(var j = 0; j < q.answer.length; j++){
							var a = q.answer[j]
							
							this.questions[i].answers.push({
								answer: a.answer,
								score: a.score
							})
						}
					}
					for(var i = 0; i < r.result.length; i++) this.results.push({
						min: r.result[i].min_score,
						max: r.result[i].max_score,
						desc: r.result[i].desc
					})
					this.loading = false
				})
		},
		methods: {
			countQuest(number){
				var data = []

				for(var i = 0; i < number; i++) data[i] = i + 1
				return data
			},
			toQuest(n){
				this.page = 0
				this.i = n - 1
			},
			openResult(d){
				this.doneDesc = d
				$('#view-done').modal()
			}
		}
	}
</script>