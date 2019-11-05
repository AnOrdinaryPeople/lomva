<template>
	<div class="bg-white p-4">
		<div class="row mb-4">
			<div class="col-9">
				<h1>{{ content.title }}</h1>
			</div>
			<div class="col-3">
				<div class="row">
					<div class="col-sm-6 col-md-9 col-lg-9 pt-2 text-right">
						<p>{{ content.name }}</p>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 pl-0">
						<img class="rounded-circle" :src="content.avatar || sauce+'/img/default.png'" width="40" height="40">
					</div>
				</div>
			</div>
		</div>
		<markdown-it-vue class="md-body" :content="desc" />
		<button class="btn btn-primary mt-4" data-toggle="modal" data-target="#confirm-test">Mulai test</button>
		<div id="confirm-test" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Konfirmasi test</h5>
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>
							Apakah kamu yakin ingin memulai test ini?<br/><br/>
							<strong>Penting!</strong><br/>
							Jawaban tidak akan disimpan jika kamu belum menyelesaikan test!
						</p>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
						<button class="btn btn-primary" @click="toTest(`/questionnaire/${$route.params.id}/test`)">Mulai test</button>
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
			desc: '',
			sauce: process.env.MIX_APP_URL
		}),
		mounted(){
			axios.post(`/questionnaire/${this.$route.params.id}`)
				.then(resp => {
					this.content = resp.data
					this.desc = resp.data.desc
				})
				.catch(err => console.error(err))
		},
		methods: {
			toTest(link){
				$('#confirm-test').modal('hide')
				this.$router.push(link)
			}
		}
	}
</script>