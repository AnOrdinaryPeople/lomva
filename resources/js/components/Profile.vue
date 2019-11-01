<template>
	<div class="bg-white w-100 h-100 p-4">
		<div v-if="info != ''" class="alert" :class="info != '' ? 'alert-success' : ''" @click="save">{{ info }}</div>
		<form autocomplete="off" @submit.prevent="save">
			<div class="row">
				<div class="col-6">
					<h1>Edit Profil</h1>
				</div>
				<div class="col-6 text-right">
					<button id="prof-btn" class="btn" :class="role > 0 ? 'btn-success' : 'btn-primary'">Save</button>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4">
					<input id="prof-upload" type="file" style="display: none" @change="imgChange" accept="image/x-png, image/gif, image/jpeg">
					<img class="img-fluid rounded-circle imej" width="250" height="250" :src="preview" @click="oven()" />
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4 pt-4">
					<label for="prof-name">Nama</label>
					<input id="prof-name" class="form-control" type="text" v-model="profile.name">
				</div>
			</div>
			<div class="row" v-if="role === 0">
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group">
						<label for="prof-gender">Jenis kelamin</label>
						<select class="form-control" v-model="profile.gender">
							<option value="1" :selected="profile.gender === 1 ? '1' : '0'">Laki-laki</option>
							<option value="0" :selected="profile.gender === 0 ? '1' : '0'">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="prof-class">Kelas</label>
						<input id="prof-class" class="form-control" type="text" v-model="profile.cls">
					</div>
					<div class="form-group">
						<label for="prof-school">Sekolah</label>
						<input id="prof-school" class="form-control" type="text" v-model="profile.school">
					</div>
					<div class="form-group">
						<label for="prof-born">Tanggal lahir</label>
						<input id="prof-born" class="form-control" type="date" v-model="profile.born">
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="form-group">
						<label for="prof-email">Email</label>
						<input id="prof-email" class="form-control" type="email" :value="email" disabled="1">
					</div>
					<div class="form-group">
						<label for="prof-pass">Password (baru)</label>
						<input id="prof-pass" class="form-control" type="password" v-model="profile.pass">
						<small v-if="errors" v-for="err in errors" class="text-danger">{{ err }}<br/></small>
					</div>
					<div class="form-group">
						<label for="prof-pass-con">Konfirmasi password (baru)</label>
						<input id="prof-pass-con" class="form-control" type="password" v-model="profile.passCon">
					</div>
					<div class="form-group">
						<label for="prof-phone">No. Telepon</label>
						<input id="prof-phone" class="form-control" type="text" v-model="profile.phone">
					</div>
				</div>
			</div>
			<div v-if="role === 1">
				<div class="form-group">
					<label for="teach-email">Email</label>
					<input id="teach-email" class="form-control" type="email" :value="email" disabled="1">
				</div>
				<div class="form-group">
					<label for="teach-pass">Password</label>
					<input id="teach-pass" class="form-control" type="password" v-model="profile.pass">
					<small v-if="errors" v-for="err in errors" class="text-danger">{{ err }}<br/></small>
				</div>
				<div class="form-group">
					<label for="teach-pass-con">Konfirmasi password</label>
					<input id="teach-pass-con" class="form-control" type="password" v-model="profile.passCon">
				</div>
				<div class="form-group">
					<label for="teach-phone">No. Telepon</label>
					<input id="teach-phone" class="form-control" type="text" v-model="profile.phone">
				</div>
				<div class="form-group">
					<label for="teach-school">Mengajar di sekolah</label>
					<input id="teach-school" class="form-control" type="text" v-model="profile.school">
				</div>
			</div>
		</form>
	</div>
</template>

<style scoped>
	.imej{ transition: all .3s ease }
	.imej:hover{
		cursor: pointer;
		opacity: .5
	}
</style>

<script>
	export default{
		data: () => ({
			sauce: process.env.MIX_APP_URL,
			role: '',
			preview: '',
			email: '',
			profile: {
				avatar: {},
				name: '',
				pass: '',
				passCon: '',
				phone: '',
				gender: '',
				cls: '',
				school: '',
				born: '',
			},
			info: '',
			errors: {}
		}),
		mounted(){
			this.role = this.$auth.user().role
			this.email = this.$auth.user().email
			this.preview = this.$auth.user().avatar || this.sauce+'/img/default.png'
			this.profile.name = this.$auth.user().name
			axios.post(`/user-profile/${this.$auth.user().id}`)
				.then(resp => {
					var r = resp.data
					this.profile.phone = r.phone || ''
					this.profile.gender = r.gender || ''
					this.profile.cls = r.cls || ''
					this.profile.school = r.school || ''
					this.profile.born = r.born ? new Date(r.born).toISOString().slice(0, 10) : ''
				}).catch(err => console.error(err))
		},
		methods: {
			imgChange(e){
				const file = e.target.files[0]

				if(file.size > 2000000) alert('Max size 2MB!!')
				else{
					this.profile.avatar = file
					this.preview = URL.createObjectURL(file)
				}
			},
			save(){
				var id = document.getElementById('prof-btn')
				let data = new FormData()

				id.setAttribute('disabled', 1)
				for(var [key, val] of Object.entries(this.profile)) data.append(key, val)

				axios.post(`/user-profile/${this.$auth.user().id}/save`, data, {
					headers: {'content-type': 'multipart/form-data'}
				}).then((resp) => {
					this.info = 'Berhasil disimpan'
					id.removeAttribute('disabled')
				}).catch(err => {
					this.errors = err.response.data.errors
					console.error(err)
					id.removeAttribute('disabled')
				})
			},
			oven(){
				document.getElementById('prof-upload').click()
			}
		}
	}
</script>
