<template>
	<div class="bg-white p-4">
		<div v-if="!isFinish" class="row">
			<div class="col-sm-12 col-md-12 col-lg-3">
				<button v-for="(i, key) in loop(total)" :id="`btn-q-${key}`" class="btn btn-outline-primary m-1" @click="toNumber(i)">{{ i }}</button>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-9">
				<h1>{{ content[n]['number'] }}. {{ content[n]['question'] }}</h1>
				<div class="form-group">
					<div v-for="(a, key) in content[n]['answer']" class="custom-control custom-radio">
						<input :id="`q-${n}-${key}`" class="custom-control-input" type="radio" name="option" @click="saveAnswer(n, a.score, key)" :checked="checker(n, key)">
						<label class="custom-control-label" :for="`q-${n}-${key}`">{{ a.answer }}</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-6">
						<button class="btn btn-secondary mr-2" @click="next(n - 1)">Soal sebelumnya</button>
						<button class="btn btn-primary" @click="next(n + 1)">Soal selanjutnya</button>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-6" :class="!resize ? 'text-right' : 'mt-2'">
						<button v-if="btnFinish" class="btn btn-warning" @click="getResult">Kirimkan jawaban</button>
					</div>
				</div>
			</div>
		</div>
		<div v-else class="container">
			<div v-if="resize">
				<div class="text-center">
					<div class="circle-sb">
						Skor akhir {{ totalScore }}
						<div class="dcircle"></div>
						<div class="dcircle1"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<img class="img-fluid" width="100px" height="100px" :src="sauce+'/img/done-1.gif'" />
					</div>
					<div class="col-6">
						<img class="img-fluid" width="100px" height="100px" :src="sauce+'/img/done-2.gif'" />
					</div>
				</div>
			</div>
			<div v-else class="row">
				<div class="col-4">
					<img class="img-fluid" width="100px" height="100px" :src="sauce+'/img/done-1.gif'" />
				</div>
				<div class="col-4">
					<div class="circle-sb">
						Skor akhir {{ totalScore }}
						<div class="dcircle"></div>
						<div class="dcircle1"></div>
					</div>
				</div>
				<div class="col-4 text-right">
					<img class="img-fluid" width="100px" height="100px" :src="sauce+'/img/done-2.gif'" />
				</div>
			</div>
			<markdown-it-vue class="md-body" :content="descFinish" />
			<router-link class="mt-4 btn btn-primary" to="/home">Kembali ke beranda</router-link>
		</div>
	</div>
</template>

<style scoped>
	.circle-sb{
		width: 250px;
		border: 5px solid #00bfb6;
		padding: 50px 0px;
		border-radius: 50%;
		text-align: center;
		font-size: 24px;
		font-weight: 900;
		position: relative;
		color: #00bfb6;
	}
	.dcircle{
		border: 5px solid #00bfb6;
		position: absolute;
		width: 25px;
		padding:20px;
		border-radius: 50%;
		right: -15px;
		bottom: 15px;
	}
	.dcircle:before{
		content: "";
		position: absolute;
		width: 25px;
		padding:20px;
		border-radius: 50%;
		right: 0px;
		bottom: 0px;
		background: #fff;
	}
	.dcircle1{
		border: 5px solid #00bfb6;
		position: absolute;
		width: 5px;
		padding:10px 15px;
		border-radius: 50%;
		right: -35px;
		bottom: 13px;
	}
	.dcircle1:before{
		content: "";
		position: absolute;
		width: 5px;
		padding:10px 15px;
		border-radius: 50%;
		right: 0px;
		bottom: 0px;
		background: #fff; 
	}
</style>

<script>
	export default{
		data: () => ({
			content: {0:{number: 1}},
			total: 0,
			n: 0,
			answer: [],
			a: [],
			result: {},
			btnFinish: false,
			isFinish: false,
			descFinish: '',
			totalScore: 0,
			sauce: process.env.MIX_APP_URL,
			resize: false
		}),
		mounted(){
			if(window.innerWidth <= 992) this.resize = true
            else this.resize = false

            window.addEventListener('resize', e => {
                if(e.target.innerWidth <= 992) this.resize =  true
                else this.resize = false
            })

			axios.post(`/questionnaire/test/${this.$route.params.id}/${this.$auth.user().id}`)
				.then(resp => {
					this.content = resp.data.data
					this.total = resp.data.total
					this.result = resp.data.result
				})
				.catch(err => {
					if(err.response.data.status === 'done'){
						this.isFinish = true
						this.$router.push(`/questionnaire`)
					}else console.error(err)
				})
		},
		methods: {
			loop(max){
				var data = []

				for(var i = 0; i < max; i++) data[i] = i + 1
				return data
			},
			toNumber(i){
				this.n = i - 1
			},
			next(i){
				if(i < 0) i = 0
				else if(i >= this.content.length) i = this.content.length - 1
				
				this.n = i
			},
			saveAnswer(n, score, key){
				this.answer[n] = {'score': score, 'key': key}
				this.a[n] = {'score': score, 'key': key}
				var id = document.getElementById('btn-q-'+n).classList

				if(!this.answer.includes(undefined) && this.total === this.answer.length) this.btnFinish = true
				else this.btnFinish = false

				id.add('btn-primary')
				id.remove('btn-outline-primary')
				this.answer = []
				this.answer = this.a
			},
			checker(n, key){
				try{
					if(this.answer[n]['key'] === key) return true
					else return false
				}catch(e){
					return false
				}
			},
			getResult(){
				var n = 0,
					r = this.result

				for(var i = 0; i < this.answer.length; i++) n += this.answer[i].score

				this.totalScore = n
				
				for(var j = 0; j < r.length; j++){
					if(n >= r[j].min_score && n <= r[j].max_score){
						this.descFinish = r[j].desc
						this.isFinish = true
						break
					}
				}
				axios.post(`/questionnaire/${this.$route.params.id}/score/${this.$auth.user().id}`, {
					score: this.totalScore
				}).then(() => {})
				.catch(err => console.error(err))
			}
		},
		beforeRouteLeave(to, from, next){
			if(this.isFinish) next()
			else{
				if(window.confirm('Apakah kamu yakin ingin keluar dari halaman ini? kamu belum menyelesaikan test ini'))
					next()
				else next(false)
			}
		}
	}
</script>