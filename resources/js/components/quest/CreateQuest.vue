<template>
	<div class="bg-white p-4">
		<div v-if="error" class="alert alert-danger">
			<ol>
				<li>Ada inputan yang kosong!</li>
				<li>Pastikan nilai skor terkecil harus lebih kecil dari skor terbesar!</li>
				<li>Pastikan nilai skor tertinggi harus lebih besar dari skor terkecil!</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-3">
				<select class="form-control" v-model="category">
					<option value="" disabled>-- Jenis kuesioner --</option>
					<option value="1" :selected="category === 1 ? true : false">Akademik</option>
					<option value="2" :selected="category === 2 ? true : false">Karir</option>
					<option value="3" :selected="category === 3 ? true : false">Sosial</option>
					<option value="4" :selected="category === 4 ? true : false">Pribadi</option>
				</select>
			</div>
			<div class="col-9">
				<input class="form-control" type="text" placeholder="Judul kuesioner" v-model="title">
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-sm-12 col-md-12 col-lg-3 mt-2">
				<div class="btn-group w-100 mb-2">
					<button class="btn" :class="page === 1 ? 'btn-success' : 'btn-outline-success'" @click="page = 1">Tentang kuesioner</button>
					<button class="btn" :class="page === 2 ? 'btn-success' : 'btn-outline-success'" @click="page = 2">Hasil kuesioner</button>
				</div>
				<button class="btn btn-block" :class="page === 3 ? 'btn-success' : 'btn-outline-success'" @click="page = 3">Lihat semua pertanyaan</button>
				<hr/>
				<button v-for="n in countQuest(questions.length)" class="btn m-1" :class="i === n - 1 ? (page === 0 ? 'btn-success' : 'btn-outline-success') : 'btn-outline-success'" @click="toQuest(n)">{{ n }}</button>
				<button class="btn btn-outline-success" title="Tambah soal" @click="addQuest(questions.length)">+</button>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-9 mt-2">
				<div v-if="page === 1">
					<div class="card">
						<div class="card-header">
							<ul class="nav nav-tabs card-header-tabs">
								<li class="nav-item">
									<a class="nav-link" :class="section === 0 ? 'active' : ''" href="#" @click.prevent="selectSection(0)">Inputan</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" :class="section === 1 ? 'active' : ''" href="#" @click.prevent="selectSection(1)">Lihat hasil</a>
								</li>
							</ul>
						</div>
						<div class="card-body">
							<textarea v-if="section === 0" class="form-control" style="height: 250px" placeholder="deskripsi tentang kuesioner ini *Bisa menggunakan format tambahan" v-model="desc"></textarea>
							<markdown-it-vue v-else-if="section === 1" class="md-body" :content="desc" />
						</div>
					</div>
				</div>
				<div v-else-if="page === 2">
					<table class="w-100">
						<tr v-for="(r, delKey) in results" class="row">
							<td class="col-2 pr-0">
								<input class="form-control" type="number" min="0" placeholder="skor terkecil" v-model="r.min">
							</td>
							<td class="col-2 px-1">
								<input class="form-control" type="number" :min="r.min" placeholder="skor terbesar" v-model="r.max">
							</td>
							<td class="px-0" :class="results.length > 1 ? 'col-6' : 'col-7 pl-1'">
								<textarea class="form-control" placeholder="penjelasan *Bisa menggunakan format tambahan" v-model="r.desc"></textarea>
							</td>
							<td class="col-1 pl-1" :class="results.length > 1 ? 'pr-0' : ''">
								<button class="btn btn-primary btn-block" @click="viewDone(delKey)"><font-awesome icon="eye" /></button>
							</td>
							<td v-if="results.length > 1" class="col-1 pl-1">
								<button class="btn btn-danger btn-block" @click="delResult(delKey)"><font-awesome icon="times" /></button>
							</td>
						</tr>
					</table>
					<button class="btn btn-success" @click="addResult">+ hasil rata-rata</button>
				</div>
				<div v-else-if="page === 3">
					<div v-for="(q, qKey) in questions" class="input-group w-100 mb-2">
						<div class="input-group-prepend">
							<button class="btn btn-success" @click="toQuest(qKey + 1)">{{ qKey + 1 }}</button>
						</div>
						<input class="form-control bg-white" type="text" disabled="1" :value="q.question">
						<div v-if="questions.length > 1" class="input-group-append">
							<button class="btn btn-danger" @click="delQuest(qKey)"><font-awesome icon="times" /></button>
						</div>
					</div>
				</div>
				<div v-else-if="page === 0">
					<div class="form-group">
						<input class="form-control" type="text" placeholder="pertanyaan" v-model="questions[i].question">
					</div>
					<table class="w-100">
						<tr v-for="(a, key) in questions[i].answers" class="row">
							<td class="col-9 pr-1">
								<input class="form-control" type="text" placeholder="jawaban" v-model="a.answer">
							</td>
							<td :class="questions[i].answers.length > 1 ? 'col-2 p-0' : 'col-3 pl-1'">
								<input class="form-control" type="number" min="0" placeholder="skor" v-model="a.score">
							</td>
							<td v-if="questions[i]['answers'].length > 1" class="col-1 pl-1">
								<button class="btn btn-danger btn-block" @click="delAnswer(key)"><font-awesome icon="times" /></button>
							</td>
						</tr>
					</table>
					<button class="btn btn-success mt-2" @click="addAnswer(i)">+ Tambah jawaban</button>
					<button v-if="questions.length > 1 && i !== 0" class="btn btn-success mt-2 ml-2" @click="dupAnswer(i)">
						<font-awesome icon="clone" /> Duplikat jawaban sebelumnya
					</button>
				</div>
			</div>
		</div>
		<div class="text-right pt-4">
			<button class="btn btn-primary" data-toggle="modal" data-target="#confirm-quest">{{ routeName == 'teacher-quest-create' ? 'Kirim' : 'Update' }} kuesioner</button>
		</div>
		<div id="confirm-quest" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Konfirmasi {{ id ? 'update' : 'kirim' }} kuesioner</h5>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Apakah anda yakin untuk {{ id ? 'mengupdate' : 'mengirim' }} kuesioner {{ title }}?<br/><br/>
						<strong>Pastikan </strong>semua inputan tidak ada yang kosong!
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
						<button id="btn-confirm-modal" class="btn btn-success" @click="confirmQuest">{{ routeName == 'teacher-quest-create' ? 'Kirim' : 'Update' }} kuesioner</button>
						<font-awesome icon="spinner" spin size="lg" class="text-primary" style="display: none" id="icon-loader" />
					</div>
				</div>
			</div>
		</div>
		<div id="view-done" class="modal fade" tabindex="-1">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Lihat hasil</h5>
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

<style scoped>
	.nav-tabs .nav-link.active {
		background-color: #fff;
		border-color: #dee2e6 #dee2e6 #fff
	}
</style>

<script>
	export default{
		data: () => ({
			title: '',
			category: 0,
			desc: '',
			i: 0,
			page: 1,
			questions: [{
				question: '',
				answers: [{
					answer: '',
					score: ''
				}]
			}],
			results: [{
				min: '',
				max: '',
				desc: '' 
			}],
			error: false,
			canLeave: false,
			id: 0,
			routeName: '',
			section: 0,
			doneDesc: ''
		}),
		mounted(){
			this.routeName = this.$route.name
			this.checkPath()
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
			selectSection(i){
				this.section = i
			},
			addQuest(n){
				this.questions.push({
					question: '',
					answers: [{
						answer: '',
						score: ''
					}]
				})
				this.i = n
			},
			delQuest(n){
				Vue.delete(this.questions, n)
			},
			addAnswer(n){
				this.questions[n].answers.push({
					answer: '',
					score: ''
				})
			},
			dupAnswer(i){
				this.questions[i].answers = JSON.parse(JSON.stringify(this.questions[i - 1].answers))
			},
			delAnswer(n){
				Vue.delete(this.questions[this.i].answers, n)
			},
			addResult(){
				this.results.push({
					min: '',
					max: '',
					desc: ''
				})
			},
			delResult(n){
				Vue.delete(this.results, n)
			},
			viewDone(n){
				this.doneDesc = this.results[n].desc
				$('#view-done').modal()
			},
			confirmQuest(){
				var id = document.getElementById('btn-confirm-modal'),
					url = this.routeName == 'teacher-quest-create' ? `quest/teacher/${this.$auth.user().id}/send` : `quest/teacher/${this.id}/update/${this.$auth.user().id}`

				id.setAttribute('disabled', 1)
				$('#icon-loader').show()

				axios.post(url, {
					title: this.title,
					category: parseInt(this.category),
					desc: this.desc,
					questions: this.questions,
					results: this.results
				}).then(() => {
					this.canLeave = true
					this.$router.push({ name: 'teacher-quest' })
					$('#confirm-quest').modal('hide')
					$('#icon-loader').hide()
					id.removeAttribute('disabled')
				}).catch(err => {
					console.error(err)
					$('#confirm-quest').modal('hide')
					$('#icon-loader').hide()
					id.removeAttribute('disabled')
					if(_.size(err.response.data) > 0) this.error = true
				})
			},
			checkPath(){
				this.id = this.$route.params.id

				if(this.routeName != 'teacher-quest-create')
					axios.post(`/quest/teacher/${this.id}/edit/${this.$auth.user().id}`)
						.then(resp => {
							var r = resp.data

							if(r.info.title === undefined) this.$router.push({name: 'teacher-quest-create'})
							else{
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
							}
						}).catch(err => console.error(err))
			}
		},
		watch: {
			$route(to){
				this.routeName = to.name
				if(to.name == 'teacher-quest-create'){
					this.title = ''
					this.content = ''
					this.questions = [{
						question: '',
						answers: [{
							answer: '',
							score: ''
						}]
					}]
					this.results = [{
						min: '',
						max: '',
						desc: '' 
					}]
				}else if(to.name == 'teacher-quest-edit') this.checkPath()
			}
		},
		beforeRouteLeave(to, from, next){
			if(this.canLeave) next()
			else{
				if(this.title != '' || this.desc != '' || this.questions.length > 1 || this.questions[0].answers.length > 1 || this.results.length > 1){
					if(window.confirm('Apakah anda yakin ingin keluar dari halaman ini? jika anda keluar dari halaman ini, kuesioner tidak akan disimpan')) next()
					else next(false)
				}else next()
			}
		}
	}
</script>