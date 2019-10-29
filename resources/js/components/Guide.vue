<template>
	<div class="container">
		<h1 id="cara-membuat-header">Cara membuat header</h1>
		<div class="row">
			<div class="col-6">
				<h4>Input</h4>
				<pre class="bg-secondary text-light p-2 rounded"># header paling besar<br/>## header mengecil<br/>###### header paling kecil</pre>
			</div>
			<div class="col-6">
				<h4>Hasil</h4>
				<h1>header paling besar</h1>
				<h2>header mengecil</h2>
				<h6>header paling kecil</h6>
			</div>
		</div>
		<hr/>
		<h1 id="cara-membuat-enter">Cara membuat enter</h1>
		<div class="row">
			<div class="col-6">
				<h4>Input</h4>
				<pre class="bg-secondary text-light p-2 rounded">ini teks pertama<br/>teks kedua tidak akan di enter<br/><br/>teks ketiga di enter</pre>
			</div>
			<div class="col-6">
				<h4>Hasil</h4>
				<p>ini teks pertama teks kedua tidak akan di enter</p>
				<p>teks ketiga di enter</p>
			</div>
		</div>
		<hr/>
		<h1 id="cara-membuat-varias-teks">Cara membuat variasi teks</h1>
		<div class="row">
			<div class="col-6">
				<h4>Input</h4>
				<pre class="bg-secondary text-light p-2 rounded">*teks bercetak miring*<br/>_teks bercetak miring juga_<br/>**teks bercetak tebal**<br/>__teks bercetak tebal juga__<br/>~~teks ini dicoret~~<br/><br/>_menggabungkan **variasi** ~~teks~~_</pre>
			</div>
			<div class="col-6">
				<h4>Hasil</h4>
				<i>teks bercetak miring</i><br/>
				<i>teks bercetak miring juga</i><br/>
				<b>teks bercetak tebal</b><br/>
				<b>teks bercetak tebal juga</b><br/>
				<s>teks ini dicoret</s><br/><br/>
				<i>menggabungkan <b>variasi</b> <s>teks</s></i>
			</div>
		</div>
		<hr/>
		<h1 id="cara-membuat-list">Cara membuat list</h1>
		<div class="row">
			<div class="col-6">
				<h4>Input</h4>
				<h6>Menggunakan simbol</h6>
				<pre class="bg-secondary text-light p-2 rounded">- list 1<br/>- list 2<br/>   - list 2.1<br/>   - list 2.2<br/>- list 3</pre>
				<h6>Menggunakan angka</h6>
				<pre class="bg-secondary text-light p-2 rounded">1. list 1<br/>1. list 2<br/>   1. list 2.1<br/>   1. list 2.2<br/>1. list 3</pre>
				<b>Catatan: </b>Untuk membuat anak list gunakan jarak 3 spasi
			</div>
			<div class="col-6">
				<h4>Hasil</h4>
				<h6>Menggunakan simbol</h6>
				<ul><li>list 1</li><li>list 2<ul><li>list 2.1</li><li>list 2.2</li></ul></li><li>list 3</li></ul>
				<h6>Menggunakan angka</h6>
				<ol><li>list 1</li><li>list 2<ol type="i"><li>list 2.1</li><li>list 2.2</li></ol></li><li>list 3</li></ol>
			</div>
		</div>
		<hr/>
		<h1 id="cara-menambah-gambar">Cara menambah gambar</h1>
		<div class="row">
			<div class="col-6">
				<h4>Input</h4>
				<pre class="bg-secondary text-light p-2 rounded">![Nama gambar]({{ sauce+'/img/default.png' }})</pre>
			</div>
			<div class="col-6">
				<h4>Hasil</h4>
				<p><img :src="sauce+'/img/default.png'" alt="Nama gambar"></p>
			</div>
		</div>
		<hr/>
		<h1 id="cara-membuat-link">Cara membuat link</h1>
		<div class="row">
			<div class="col-6">
				<h4>Input</h4>
				<pre class="bg-secondary text-light p-2 rounded">[Coba cek sini](https://google.com)<br/><br/>https://google.com - otomatis</pre>
			</div>
			<div class="col-6">
				<h4>Hasil</h4>
				<p><a href="https://google.com" target="_blank" rel="noopener">Coba cek sini</a></p>
				<p><a href="https://google.com" target="_blank" rel="noopener">https://google.com</a> - otomatis</p>
			</div>
		</div>
		<hr/>
		<h1 id="cara-membuat-blockquotes">Cara membuat blockquotes</h1>
		<div class="row">
			<div class="col-6">
				<h4>Input</h4>
				<pre class="bg-secondary text-light p-2 rounded">Dia berkata:<br/>> aku normal<br/>> dia normal</pre>
			</div>
			<div class="col-6">
				<h4>Hasil</h4>
				<p>Dia berkata:</p>
				<blockquote style="border-left: .25rem solid #dfe2e5;color: #6a737d;padding: 0 1em;margin: 0"><p>aku normal dia normal</p></blockquote>
			</div>
		</div>
		<hr/>
		<h1 id="cara-menandakan-teks">Cara menandakan teks</h1>
		<div class="row">
			<div class="col-6">
				<h4>Input</h4>
				<pre class="bg-secondary text-light p-2 rounded">kata yang paling `penting` adalah itu</pre>
			</div>
			<div class="col-6">
				<h4>Hasil</h4>
				<p>kata yang paling <code style="background-color:rgba(27,31,35,.05);border-radius: 3px;font-size: 85%;margin: 0;padding: .2em .4em;font-family:SFMono-Regular,Consolas,Liberation Mono,Menlo,Courier,monospace;color: #f66d9b;word-break: break-word">penting</code> adalah itu</p>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		name: 'guide',
		data: () => ({
			sauce: process.env.MIX_APP_URL
		})
	}
</script>