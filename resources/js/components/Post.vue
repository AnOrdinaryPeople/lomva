<template>
	<div class="bg-white h-100 p-4">
		<div class="row">
			<div class="col-8">
				<h1>{{ title }}</h1>
			</div>
			<div class="col-4 text-right">
				<p>{{ name }} <img class="img-fluid rounded-circle" :src="avatar" width="40" height="40"></p>
			</div>
		</div>
		<markdown-it-vue class="md-body" :content="content" />
	</div>
</template>

<script>
	import MarkdownItVue from 'markdown-it-vue'
	import 'markdown-it-vue/dist/markdown-it-vue.css'

	export default{
		components: { MarkdownItVue },
		data: () => ({
			title: '',
			content: '',
			name: '',
			avatar: '',
			sauce: process.env.MIX_APP_URL
		}),
		mounted(){
			axios.post(`/get-post/${this.$route.params.id}`)
				.then(resp => {
					this.title = resp.data.title
					this.content = resp.data.desc
					this.name = resp.data.name
					this.avatar = resp.data.avatar || this.sauce+'/img/default.png'
				})
		}
	}
</script>