<template>
	<div class="bg-white p-4">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-3 mt-2">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="text-center" :class="resize ? 'col-6' : 'col-5'">
								<font-awesome icon="list" size="3x" />
							</div>
							<div class="text-right" :class="resize ? 'col-6' : 'col-7'">
								<p>Jumlah Postingan<br/>{{ counter.post }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-3 mt-2">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="text-center" :class="resize ? 'col-6' : 'col-5'">
								<font-awesome icon="pen-square" size="3x" />
							</div>
							<div class="text-right" :class="resize ? 'col-6' : 'col-7'">
								<p>Jumlah Kuesioner<br/>{{ counter.quest }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-3 mt-2">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-6 text-center">
								<font-awesome icon="users" size="3x" />
							</div>
							<div class="col-6 text-right">
								<p>Jumlah Guru<br/>{{ counter.teacher }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-3 mt-2">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-6 text-center">
								<font-awesome icon="user-graduate" size="3x" />
							</div>
							<div class="col-6 text-right">
								<p>Jumlah Siswa<br/>{{ counter.student }}</p>
							</div>
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
			counter: {},
			resize: ''
		}),
		mounted(){
			if(window.innerWidth <= 992) this.resize = true
            else this.resize = false

            window.addEventListener('resize', e => {
                if(e.target.innerWidth <= 992) this.resize =  true
                else this.resize = false
            })
        	axios.post('/admin/count')
        		.then(resp => this.counter = resp.data)
        		.catch(err => console.error(err))
		}
	}
</script>