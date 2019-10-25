<template>
	<div class="container">
		<div class="card">
			<div class="card-header">
				<ul class="nav nav-tabs card-header-tabs">
					<li class="nav-item">
						<a class="nav-link" href="#" :class="role === 0 ? 'active' : ''" @click="btnReg(0)">Daftar sebagai siswa</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" :class="role === 1 ? 'active' : ''" @click="btnReg(1)">Daftar sebagai guru BK</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<div v-if="has_error" class="alert alert-danger">Ada error</div>
				<form autocomplete="off" @submit.prevent="register" method="post">
					<div class="form-group">
						<label for="reg-email">Email</label>
						<input id="reg-email" class="form-control" :class="has_error && errors.email ? 'is-invalid' : ''" type="email" v-model="email">
						<small v-if="has_error && errors.email" v-for="errEmail in errors.email" class="text-danger">{{ errEmail }}<br/></small>
					</div>
					<div class="form-group">
						<label for="reg-pass">Password</label>
						<input id="reg-pass" class="form-control" :class="has_error && errors.password ? 'is-invalid' : ''" type="password" v-model="pass">
						<small v-if="has_error && errors.password" v-for="errPass in errors.password" class="text-danger">{{ errPass }}<br/></small>
					</div>
					<div class="form-group">
						<label for="reg-con-pass">Confirm password</label>
						<input id="reg-con-pass" class="form-control" type="password" v-model="passCon">
					</div>
					<div class="form-group">
						<vue-recaptcha ref="recaptcha" @verify="onVerify" :sitekey="key"></vue-recaptcha>
						<small v-if="has_error && errors.recaptcha" v-for="errRecap in errors.recaptcha" class="text-danger">{{ errRecap }}<br/></small>
					</div>
					<button id="btn-reg-submit" class="btn btn-primary" type="submit">Daftar</button>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	import VueRecaptcha from 'vue-recaptcha'

	export default{
		components: {
			VueRecaptcha
		},
		data: () => ({
			key: process.env.MIX_SITE_KEY,
			email: '',
			pass: '',
			passCon: '',
			role: 0,
			recaptcha: '',
			has_error: false,
			errors: {},
		}),
		methods: {
			onVerify(resp){
				this.recaptcha = resp
			},
			register(){
				var id = document.getElementById('btn-reg-submit')

				id.setAttribute('disabled', 1)
				this.$auth.register({
					data: {
						email: this.email,
						password: this.pass,
						password_confirmation: this.passCon,
						role: this.role,
						recaptcha: this.recaptcha
					},
					success: () => {
						this.$router.push({
							name: 'login',
							params: {
								successRegistrationRedirect: true
							}
						})
						id.removeAttribute('disabled')
						this.$refs.recaptcha.reset()
					},
					error: (resp) => {
						this.has_error = true
						this.errors = resp.response.data.errors || {}
						id.removeAttribute('disabled')
					}
				})
			},
			btnReg(role){
				this.role = role
			}
		}
	}
</script>