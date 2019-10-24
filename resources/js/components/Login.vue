<template>
	<div class="container">
		<div class="card">
			<div class="card-header">Login</div>
			<div class="card-body">
				<div v-if="has_error" class="alert alert-danger">Email atau password salah</div>
				<form autocomplete="off" @submit.prevent="login" method="post">
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
			has_error: false,
			errors: {}
		}),
		methods: {
			login(){
				var id = document.getElementById('btn-log-submit'),
					rdr = this.$auth.redirect()

				id.setAttribute('disabled', 1)
				this.$auth.login({
					data: {
						email: this.email,
						password: this.pass
					},
					success: () => {
						this.$router.push({name: rdr ? rdr.from.name : this.$auth.user().role === 1 ? 'home-teacher' : 'home-user' })
						id.removeAttribute('disabled')
					},
					error: () => {
						this.has_error = true
						id.removeAttribute('disabled')
					},
					rememberMe: true,
					fetchUser: true
				})
			}
		}
	}
</script>