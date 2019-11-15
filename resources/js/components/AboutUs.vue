<template>
	<div class="container">
		<div class="card mb-3">
			<div class="row no-gutters">
				<div class="col-sm-12 col-md-5 col-lg-4">
					<img class="w-100 h-100" :class="resize ? 'rounded-top' : 'rounded-left'" :src="sauce+'/img/about-1.jpeg'">
				</div>
				<div class="col-sm-12 col-md-7 col-lg-8">
					<div class="card-body">
						<h1>Dyandra Ayu Kurniawati Sri Purwanto</h1>
						<p style="margin-top: -.5rem">Front-end</p>
						<hr>
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="row mb-2">
									<div class="col-2 text-center">
										<font-awesome icon="phone" size="lg" />
									</div>
									<div class="col-10">
										+62 813-8540-2003
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="row">
									<div class="col-2 text-center">
										<font-awesome icon="birthday-cake" size="lg" />
									</div>
									<div class="col-10">
										Bandar Lampung, 18 April 2003
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="row mb-2">
									<div class="col-2 text-center">
										<font-awesome icon="envelope" size="lg" />
									</div>
									<div class="col-10">
										dyandraksp@gmail.com
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="row">
									<div class="col-2 text-center">
										<font-awesome icon="graduation-cap" size="lg" />
									</div>
									<div class="col-10">
										SDN Turangga Bandung<br>
										SMPN 31 Bandung<br>
										SMK BPI Bandung
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="w-100 btn-group" :class="'position-'+(resize ? 'relative' : 'absolute')" style="bottom: 0">
					<button class="btn btn-primary btn-lg rounded-custom">
						<font-awesome :icon="['fab', 'bootstrap']" size="lg" /> Bootstrap
					</button>
					<button class="btn btn-primary btn-lg">
						<font-awesome :icon="['fab', 'html5']" size="lg" /> HTML
					</button>
					<button class="btn btn-primary btn-lg rounded-custom">
						<font-awesome :icon="['fab', 'js']" size="lg" /> Javascript
					</button>
				</div>
			</div>
		</div>
		<div class="card mb-3">
			<div class="row no-gutters">
				<div class="col-sm-12 col-md-5 col-lg-4">
					<img class="w-100 h-100" :class="resize ? 'rounded-top' : 'rounded-left'" :src="sauce+'/img/about-2.jpeg'">
				</div>
				<div class="col-sm-12 col-md-7 col-lg-8">
					<div class="card-body">
						<h1>Muhammad Dafitra Ar-Rasyid</h1>
						<p style="margin-top: -.5rem">Back-end</p>
						<hr>
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="row mb-2">
									<div class="col-2 text-center">
										<font-awesome icon="phone" size="lg" />
									</div>
									<div class="col-10">
										+62 812-1421-0386
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="row">
									<div class="col-2 text-center">
										<font-awesome icon="birthday-cake" size="lg" />
									</div>
									<div class="col-10">
										Bandung, 15 Desember 2001
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="row mb-2">
									<div class="col-2 text-center">
										<font-awesome icon="envelope" size="lg" />
									</div>
									<div class="col-10">
										dafitra297@gmail.com
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="row">
									<div class="col-2 text-center">
										<font-awesome icon="graduation-cap" size="lg" />
									</div>
									<div class="col-10">
										SD Assalaam Bandung<br>
										SMP Assalaam Bandung<br>
										SMK BPI Bandung
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="w-100 btn-group" :class="'position-'+(resize ? 'relative' : 'absolute')" style="bottom: 0">
					<button class="btn btn-primary btn-lg rounded-custom">
						<font-awesome :icon="['fab', 'laravel']" size="lg" /> Laravel
					</button>
					<button class="btn btn-primary btn-lg rounded-custom">
						<font-awesome :icon="['fab', 'vuejs']" size="lg" /> Vue.JS
					</button>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="row no-gutters">
				<div class="col-sm-12 col-md-5 col-lg-4">
					<img class="w-100 h-100" :class="resize ? 'rounded-top' : 'rounded-left'" :src="sauce+'/img/about-3.jpeg'">
				</div>
				<div class="col-sm-12 col-md-7 col-lg-8">
					<div class="card-body">
						<h1>Rayhanda Putra</h1>
						<p style="margin-top: -.5rem">Front-end</p>
						<hr>
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="row mb-2">
									<div class="col-2 text-center">
										<font-awesome icon="phone" size="lg" />
									</div>
									<div class="col-10">
										+62 853-5787-7251
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="row">
									<div class="col-2 text-center">
										<font-awesome icon="birthday-cake" size="lg" />
									</div>
									<div class="col-10">
										Bandung, 10 Agustus 2002
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="row mb-2">
									<div class="col-2 text-center">
										<font-awesome icon="envelope" size="lg" />
									</div>
									<div class="col-10">
										rayhandaputra10@gmail.com 
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6">
								<div class="row">
									<div class="col-2 text-center">
										<font-awesome icon="graduation-cap" size="lg" />
									</div>
									<div class="col-10">
										MI Assalaam Palembang<br>
										SMPIT Al-Azhar Assyarif Palembang<br>
										SMK BPI Bandung
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="w-100 btn-group" :class="'position-'+(resize ? 'relative' : 'absolute')" style="bottom: 0">
					<button class="btn btn-primary btn-lg rounded-custom">
						<font-awesome :icon="['fab', 'bootstrap']" size="lg" /> Bootstrap
					</button>
					<button class="btn btn-primary btn-lg">
						<font-awesome :icon="['fab', 'html5']" size="lg" /> HTML
					</button>
					<button class="btn btn-primary btn-lg rounded-custom">
						<font-awesome :icon="['fab', 'js']" size="lg" /> Javascript
					</button>
				</div>
			</div>
		</div>
	</div>
</template>

<style scoped>
	.rounded-custom{
		border-top-left-radius: 0;
		border-top-right-radius: 0
	}
	.btn-group .btn{ cursor: default }
	.btn-group .btn:focus{ box-shadow: none }
</style>

<script>
	export default{
		data: () => ({
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
		}
	}
</script>