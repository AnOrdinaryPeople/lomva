<template>
<<<<<<< HEAD
  <div class="bg-white p-4">
    <laravel-vue-pagination :data="content" @pagination-change-page="changePage"></laravel-vue-pagination>
    <div v-if="content.total > 0">
      <div v-for="c in content.data" class="card mb-4" @click="goTo(c.toId)">
        <div class="card-body">
          <h1 class="text-bold">{{ c.title }}</h1>
          <p class="text-secondary">{{ regexDesc(c.desc) }}</p>
          <div class="row">
            <div class="col">
              <small>
                Dibuat oleh
                <strong>{{ c.name }}</strong>
                | {{ dateFill(c.date_post) }}
              </small>
            </div>
            <div class="col">
              <div class="text-right">
                <small>Comments (...)</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="text-center">
      <h1>
        Hasil
        <i>{{ $route.query.q }}</i> tidak ditemukan
      </h1>
      <h4>Silahkan coba cari lagi</h4>
    </div>
    <laravel-vue-pagination :data="content" @pagination-change-page="changePage"></laravel-vue-pagination>
  </div>
=======
	<div class="bg-white p-4">
		<div v-if="loader" class="text-center">
			<font-awesome icon="spinner" spin size="3x" class="text-primary" />
		</div>
		<div v-else>
			<laravel-vue-pagination :data="content" @pagination-change-page="changePage"></laravel-vue-pagination>
			<div v-if="content.total > 0">
				<div v-for="c in content.data" class="card mb-4 shadow" @click="goTo(c.toId)">
					<div class="card-body">
						<h1 class="text-bold">{{ c.title }}</h1>
						<p class="text-secondary">{{ regexDesc(c.desc) }}</p>
						<div class="row">
							<div class="col">
								<small>Dibuat oleh <strong>{{ c.name }}</strong> | {{ dateFill(c.date_post) }}</small>
							</div>
							<div class="col">
								<div class="text-right">
									<small>Komentar ({{ c.total }})</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div v-else class="text-center">
				<h1>Hasil <i>{{ $route.query.q }}</i> tidak ditemukan</h1>
				<h4>Silahkan coba cari lagi</h4>
			</div>
			<laravel-vue-pagination :data="content" @pagination-change-page="changePage"></laravel-vue-pagination>
		</div>
	</div>
>>>>>>> 69b48795bb81487b4574e129fd3dbeb07e557dc4
</template>

<style scoped>
.card {
  transition: all 0.3s ease;
}
.card:hover {
  opacity: 0.5;
  cursor: pointer;
}
</style>

<script>
<<<<<<< HEAD
export default {
  data: () => ({
    content: { total: 1 },
    sauce: ""
  }),
  mounted() {
    const q = this.$route.query.q;
    this.sauce =
      this.$auth.user().role === 1 ? "/all-post/with-bk" : "/all-post/public";

    if (q)
      axios
        .post("/post-search", { search: q, role: this.$auth.user().role || 0 })
        .then(resp => (this.content = resp.data))
        .catch(err => console.error(err));
    else
      axios
        .post(this.sauce)
        .then(resp => (this.content = resp.data))
        .catch(err => console.error(err));
  },
  methods: {
    goTo(id) {
      this.$router.push({ path: "/post/" + id });
    },
    changePage(page = 1) {
      axios
        .post(this.sauce + "?page=" + page)
        .then(resp => (this.content = resp.data))
        .catch(err => console.error(err));
    },
    dateFill(date) {
      var d = new Date(date);
      return d.toLocaleString("id-ID", { dateStyle: "medium" });
    },
    regexDesc(desc) {
      var d = desc
        .replace(/\[([^])*\]/, "")
        .replace(/\(([^])*\)/, "")
        .replace(/[#*_~>\`]/g, "");

      return d.length > 50 ? d.substring(0, 50) + "...." : d;
    }
  },
  watch: {
    $route(to) {
      axios
        .post("/post-search", {
          search: this.$route.query.q,
          role: this.$auth.user().role || 0
        })
        .then(resp => (this.content = resp.data))
        .catch(err => console.error(err));
    }
  }
};
=======
	export default{
		data: () => ({
			content: {total: 1},
			sauce: '',
			loader: true
		}),
		mounted(){
			this.checkPath()
		},
		methods: {
			goTo(id){
				this.$router.push({ path: '/post/'+id })
			},
			changePage(page = 1){
				axios.post(this.sauce+'?page='+page)
					.then(resp => this.content = resp.data)
					.catch(err => console.error(err))
			},
			dateFill(date){
				var d = new Date(date)
				return d.toLocaleString('id-ID', {dateStyle: 'medium'})
			},
			regexDesc(desc){
				var d = desc.replace(/\[([^])*\]/, '')
					.replace(/\(([^])*\)/, '')
					.replace(/[#*_~>\`]/g, '')

				return desc.length > 50 ? desc.substring(0, 50)+'....' : d
			},
			checkPath(){
				const q = this.$route.query.q
				this.sauce = this.$auth.user().role === 1 ? '/all-post/with-bk' : '/all-post/public'

				if(q) axios.post('/post-search', {search: q, role: this.$auth.user().role || 0})
					.then(resp => {
						this.content = resp.data
						this.loader = false
					})
					.catch(err => console.error(err))
				else axios.post(this.sauce)
					.then(resp => {
						this.content = resp.data
						this.loader = false
					})
					.catch(err => console.error(err))
			}
		},
		watch: {
			$route(to){
				this.checkPath()
			}
		}
	}
>>>>>>> 69b48795bb81487b4574e129fd3dbeb07e557dc4
</script>