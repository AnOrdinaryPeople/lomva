<template>
	<div class="jumbroton jumbroton-fluid mt-0">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-sm-12 col-md-9 col-lg-6">
					<div class="card p-3">
						<div class="card-body">
							<h1 class="text-center">Login</h1>
							<div v-if="has_error" class="alert alert-danger">Email atau password salah</div>
							<form autocomplete="off" @submit.prevent="login()" method="post">
								<div class="form-group">
									<label for="log-email"><font-awesome icon="envelope" /> Email</label>
									<input id="log-email" class="form-control" type="email" v-model="email" autofocus>
								</div>
								<div class="form-group">
									<label for="log-pass"><font-awesome icon="key" /> Password</label>
									<input id="log-pass" class="form-control" type="password" v-model="pass">
								</div>
								<button id="btn-log-submit" class="btn btn-primary"><font-awesome icon="sign-in-alt" /> Masuk</button>
								<font-awesome icon="spinner" spin size="lg" class="text-primary" style="display: none" id="icon-loader" />
							</form>
							<hr/>
							<button class="btn btn-google btn-block" @click="authProvider('google')">
								<font-awesome :icon="['fab', 'google']" /> Login dengan Google
							</button>
							<button class="btn btn-facebook btn-block" @click="authProvider('facebook')">
								<font-awesome :icon="['fab', 'facebook-f']" /> Login dengan Facebook
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data: () => ({
			email: '',
			pass: '',
			has_error: false
		}),
		mounted(){
			const q = this.$route.query.token
			
			if(q){
				var data = JSON.parse(atob(q))
				this.login(data.email, data.pass)
			}
		},
		methods: {
			login(e = '', p = ''){
				var id = document.getElementById('btn-log-submit')

				id.setAttribute('disabled', 1)
				$('#icon-loader').show()

				this.$auth.login({
					data: {
						email: e !== '' ? e : this.email,
						password: p !== '' ? p : this.pass
					},
					success: () => {
						this.$router.push({ name: 'home' })
						id.removeAttribute('disabled')
						$('#icon-loader').hide()
					},
					error: () => {
						this.has_error = true
						id.removeAttribute('disabled')
						$('#icon-loader').hide()
					},
					rememberMe: true,
					fetchUser: true
				})
			},
			authProvider(prov){
				axios({
					method: 'GET',
					url: `/auth/${prov}/redirect`,
					headers: {'Authorization': null}
				}).then(resp => {
					window.location.href = resp.data.uri
				}).catch(err => {
					console.log(err)
				})
			}
		}
	}
</script>