<template>
	<div class="container">
		<div class="card">
			<div class="card-header">Login</div>
			<div class="card-body">
				<div v-if="has_error" class="alert alert-danger">Email atau password salah</div>
				<button class="btn btn-google" @click="authProvider('google')">Login dengan Google</button>
				<button class="btn btn-facebook" @click="authProvider('facebook')">Login dengan Facebook</button>
				<form autocomplete="off" @submit.prevent="login()" method="post">
					<div class="form-group">
						<label for="log-email">Email</label>
						<input id="log-email" class="form-control" type="email" v-model="email">
					</div>
					<div class="form-group">
						<label for="log-pass">Password</label>
						<input id="log-pass" class="form-control" type="password" v-model="pass">
					</div>
					<button id="btn-log-submit" class="btn btn-primary">Masuk</button>
				</form>
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
				var id = document.getElementById('btn-log-submit'),
					rdr = this.$auth.redirect()

				id.setAttribute('disabled', 1)
				this.$auth.login({
					data: {
						email: e !== '' ? e : this.email,
						password: p !== '' ? p : this.pass
					},
					success: () => {
						this.$router.push({name: 'dashboard' })
						id.removeAttribute('disabled')
					},
					error: () => {
						this.has_error = true
						id.removeAttribute('disabled')
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