<template>
<<<<<<< HEAD
  <div>
    <h1>HELLO WORLD</h1>
  </div>
=======
	<div>
		<div class="container-fluid h-100">
		    <div class="row align-items-center header-img h-vh" :style="'background-image:url('+sauce+'/img/header-img.jpg)'">
		        <div class="col-6 mx-auto text-center text-light">
	                <h1 class="header-txt"><strong>Hold</strong> on <strong>Pain</strong> Ends</h1>
	                <router-link v-if="!$auth.check()" class="btn btn-success rounded-pill px-4 py-2" to="/register">Berbabung</router-link>
		        </div>
		    </div>
		</div>
		<div class="container-fluid p-4 bg-light">
			<div class="row p-4">
				<div class="col-sm-12 col-md-6 col-lg-6" :class="resize ? 'text-center' : 'text-right'">
					<img class="img-fluid" width="550" height="250" :src="sauce+'/img/talk.jpeg'" />
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6 pt-4" :class="resize ? 'text-center' : ''">
					<h1 style="font-size: 40px">CURHAT DENGAN <br><strong>GURU BK</strong> DAN<br>TEMAN-TEMAN<br> DI <strong>SEKOLAH</strong> MU</h1>
					<router-link class="btn btn-primary rounded-pill px-4" to="/home">POSTINGAN</router-link>
				</div>
			</div>
			<div class="pt-4"></div>
			<div class="pt-4"></div>
			<div class="container card shadow p-4 mt-4">
				<div class="row px-4 pt-4">
					<div class="col-sm-12 col-md-12 col-lg-4 mb-4">
						<div class="row">
							<div class="col-3 text-center"><font-awesome icon="hand-paper" size="3x" /></div>
							<div class="col-9"><h4>JANGAN MINDER</h4></div>
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-4 mb-4">
						<div class="row">
							<div class="col-3 text-center"><font-awesome icon="comments" size="3x" /></div>
							<div class="col-9"><h4>KONSULTASI</h4></div>
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-4 mb-4">
						<div class="row">
							<div class="col-3 text-center"><font-awesome icon="user-check" size="3x" /></div>
							<div class="col-9"><h4>AKTUALISASIKAN</h4></div>
						</div>
					</div>
				</div>
			</div>
			<div class="pt-4"></div>
		</div>
		<div class="container-fluid bg-white py-4">
			<div class="container py-4">
				<div class="row">
					<div class="col-sm-12 col-md-8 col-lg-6" :class="resize ? 'text-center' : 'text-right'">
						<h1 style="font-size: 2.75rem">KONSULTASI DENGAN <br/><strong>GURU BK</strong> TANPA <br/>BERTEMU</h1>
						<router-link class="btn btn-success rounded-pill px-4 mb-4" to="/register">DAFTAR SEKARANG</router-link>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-6 text-center">
						<img class="img-fluid w-100 h-100" :src="sauce+'/img/ask.jpeg'" />
					</div>
				</div>
			</div>
		</div>
	</div>
>>>>>>> 69b48795bb81487b4574e129fd3dbeb07e557dc4
</template>

<style scoped>
	.header-img{
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover
	}
	.header-txt{
		font-size: 60px;
		text-shadow: 1px 1px 1px rgba(0, 0, 0, .7)
	}
	.h-vh{
		padding-top: 1.25rem;
		padding-bottom: 1.25rem;
		height: 100vh
	}
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