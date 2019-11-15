<template>
    <div>
        <div id="app-back-top" class="text-light text-center rounded-circle pt-3" :class="$auth.user().role ? 'bg-primary' : 'bg-success'" style="display: none" @click="appToTop">
            <font-awesome :icon="['fas', 'angle-up']" size="lg" />
        </div>
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm" :class="$auth.user().role ? 'bg-success' : 'bg-primary'">
            <router-link class="navbar-brand" :to="$auth.user().role === 2 ? '/dashboard' : '/'"><img :src="sauce+'/img/ini.png'" width="75" height="30" /></router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul v-if="$auth.check() && $auth.user().role !== 2" class="navbar-nav mr-auto">
                    <li v-if="!resize && $router.currentRoute.name == 'homepage'">
                        <router-link class="nav-link" to="/home">
                            <font-awesome icon="home" /> Beranda
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <form>
                            <div class="input-group">
                                <input class="form-control" type="text" v-model="searchApp" placeholder="Cari postingan..">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-light" @click.prevent="btnSearchApp"><font-awesome icon="search" /></button>
                                </div>
                            </div>
                        </form>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" to="/home">
                            <font-awesome icon="home" /> Beranda
                        </router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" :to="$auth.user().role === 1 ? '/teacher/questionnaire' : '/questionnaire'">
                            <font-awesome icon="pen-square" /> Kuesioner
                        </router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link v-if="$auth.user().role === 1" class="nav-link" to="/students">
                            <font-awesome icon="users" /> Daftar siswa
                        </router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" to="/chat">
                            <font-awesome icon="comments" /> Konsultasi
                        </router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" to="/add-post">
                            <font-awesome icon="plus-square" /> Buat postingan baru
                        </router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" to="/my-post">
                            <font-awesome icon="list" /> Postinganku
                        </router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <a class="nav-link" href="#" @click.prevent="openAppModal()">
                            <font-awesome icon="info-circle" /> Format tambahan
                        </a>
                    </li>
                </ul>
                <ul v-else-if="$auth.user().role === 2" class="navbar-nav mr-auto">
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" to="/dashboard">
                            <font-awesome icon="columns" /> Dashboard
                        </router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" to="/teacher-list">
                            <font-awesome icon="users" /> Daftar Guru
                        </router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" to="/student-list">
                            <font-awesome icon="user-graduate" /> Daftar Siswa
                        </router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" to="/questionnaire-list">
                            <font-awesome icon="pen-square" /> Kuesioner
                        </router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" to="/post-list">
                            <font-awesome icon="list" /> Postingan
                        </router-link>
                    </li>
                </ul>
                <ul v-else class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/home"><font-awesome icon="home" /> Beranda</router-link>
                    </li>
                    <li class="nav-item">
                        <form>
                            <div class="input-group">
                                <input class="form-control" type="text" v-model="searchApp" placeholder="Cari postingan..">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-light" @click.prevent="btnSearchApp"><font-awesome icon="search" /></button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
                <ul v-if="!$auth.check()" class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/login"><font-awesome icon="sign-in-alt" /> Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/register"><font-awesome icon="user-plus" /> Register</router-link>
                    </li>
                </ul>
                <ul v-else-if="$auth.check()" class="navbar-nav ml-auto">
                    <li class="nav-item dropdown dropleft">
                        <a id="profDropdown" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                            {{ $auth.user().name }} <img class="img-fluid rounded-circle" :src="$auth.user().avatar ? $auth.user().avatar : sauce+'/img/default.png'" width="30" height="30" />
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profDropdown">
                            <router-link v-if="$auth.user().role !== 2" class="dropdown-item" to="/profile"><font-awesome :icon="['far', 'user']" /> Profil</router-link>
                            <a class="dropdown-item" href="#" @click.prevent="$auth.logout()"><font-awesome icon="sign-out-alt" /> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid" :class="$router.currentRoute.name == 'login' || $router.currentRoute.name == 'register' ? 'bg-au-ah' : ($router.currentRoute.name == 'homepage' ? 'px-0 mx-0' : '')">
            <div :class="$auth.check() ? (!resize ? ($router.currentRoute.name == 'homepage' ? '' : 'row') : '') : ''">
                <div v-if="$auth.check() && $router.currentRoute.name !== 'homepage'" :class="!resize ? 'col-2 bg-white position-sticky overflow-auto shadow-sm' : 'invisible'" :style="!resize ? 'height: 100vh;top: 0' : ''">
                    <nav v-if="$auth.user().role !== 2 && !resize" class="nav nav-pills flex-column pt-3">
                        <router-link class="nav-link" to="/home">
                            <font-awesome icon="home" size="lg" /> Beranda
                        </router-link>
                        <router-link class="nav-link" :to="$auth.user().role === 1 ? '/teacher/questionnaire' : '/questionnaire'">
                            <font-awesome icon="pen-square" size="lg" /> Kuesioner
                        </router-link>
                        <router-link v-if="$auth.user().role === 1" class="nav-link" to="/students">
                            <font-awesome icon="users" size="lg" /> Daftar siswa
                        </router-link>
                        <router-link class="nav-link" to="/chat">
                            <font-awesome icon="comments" size="lg" /> Konsultasi
                        </router-link>
                        <router-link class="nav-link" to="/add-post">
                            <font-awesome icon="plus-square" size="lg" /> Buat postingan baru
                        </router-link>
                        <router-link class="nav-link" to="/my-post">
                            <font-awesome icon="list" size="lg" /> Postinganku
                        </router-link>
                        <a class="nav-link" href="#" @click.prevent="openAppModal()">
                            <font-awesome icon="info-circle" size="lg" /> Format tambahan
                        </a>
                    </nav>
                    <nav v-else-if="$auth.user().role === 2 && !resize" class="nav nav-pills flex-column pt-3">
                        <router-link class="nav-link" to="/dashboard">
                            <font-awesome icon="columns" /> Dashboard
                        </router-link>
                        <router-link class="nav-link" to="/teacher-list">
                            <font-awesome icon="users" /> Daftar Guru
                        </router-link>
                        <router-link class="nav-link" to="/student-list">
                            <font-awesome icon="user-graduate" /> Daftar Siswa
                        </router-link>
                        <router-link class="nav-link" to="/questionnaire-list">
                            <font-awesome icon="pen-square" /> Kuesioner
                        </router-link>
                        <router-link class="nav-link" to="/post-list">
                            <font-awesome icon="list" /> Postingan
                        </router-link>
                    </nav>
                </div>
                <div :class="$auth.check() 
                    ? (!resize  ? ($router.currentRoute.name == 'homepage' ? 'container-fluid px-0' : 'col-10 py-4 px-4')
                                : ($router.currentRoute.name == 'homepage' ? 'container-fluid px-0' : 'container py-4'))
                    : ($router.currentRoute.name == 'homepage' ? 'container-fluid px-0' : 'container py-4')">
                    <transition name="slide-fade" mode="out-in" @beforeLeave="before" @enter="enter" @afterEnter="after">
                        <router-view></router-view>
                    </transition>
                </div>
            </div>
        </div>
        <footer class="container-fluid text-light px-0 mx-0" :class="$auth.user().role ? 'foot-gr' : 'foot-bl'">
            <div class="p-4 row container-fluid">
                <div class="col-sm-12 col-md-6 col-lg-3 pt-4">
                    <div class="row mt-2">
                        <div class="col-6 text-right">
                            <img class="img-fluid" width="100" height="300" :src="sauce+'/img/bpi.png'" />
                        </div>
                        <div class="col-6 pt-4 pl-0">
                            <h1 class="mt-3">SMK BPI</h1>
                        </div>
                    </div>
                    <div class="mt-2 text-center">
                        <blockquote class="blockquote font-italic">Bermatabat, berkualitas, dan terpercaya</blockquote>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 text-center">
                    <h1>Sosial Media</h1>
                    <div class="bg-light pt-1 mb-3"></div>
                    <p><a class="text-light text-decoration-none" href="https://facebook.com/SmkBpiBandung" target="_blank">
                        <font-awesome :icon="['fab', 'facebook-f']" /> Facebook</a>
                    </p>
                    <p><a class="text-light text-decoration-none" href="https://plus.google.com/u/0/114124411410825383869" target="_blank">
                        <font-awesome :icon="['fab', 'google']" /> Google</a>
                    </p>
                    <p><a class="text-light text-decoration-none" href="https://instagram.com/smkbpibandung" target="_blank">
                        <font-awesome :icon="['fab', 'instagram']" /> Instagram</a>
                    </p>
                    <p><a class="text-light text-decoration-none" href="https://twitter.com/smkbpibdg" target="_blank">
                        <font-awesome :icon="['fab', 'twitter']" /> Twitter</a>
                    </p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3" :class="resize ? 'text-center' : ''">
                    <h1 class="text-center">Kontak</h1>
                    <div class="bg-light pt-1 mb-3"></div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <strong><font-awesome icon="map-marker-alt" /> Alamat</strong>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-8">Jl. Burangrang no. 8 Bandung, Jawa Barat</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <strong><font-awesome icon="envelope" /> Email</strong>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-8">info@smkbpi.sch.id</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <strong><font-awesome icon="phone-alt" /> Telepon</strong>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-8">(022) 7301739 - 7305735</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <strong><font-awesome icon="globe" /> Website</strong>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-8"><a class="text-light text-decoration-none" href="http://smkbpi.sch.id/" target="_blank">www.smkbpi.sch.id</a></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 text-center">
                    <h1>Lokasi</h1>
                    <div class="bg-light pt-1 mb-3"></div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3960.71869822923!2d107.6176261!3d-6.9241913!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e62b720d1d17%3A0xe06423459ac57fad!2sJl.+Burangrang+No.8%2C+Burangrang%2C+Lengkong%2C+Kota+Bandung%2C+Jawa+Barat+40262!5e0!3m2!1sid!2sid!4v1480509908449" width="260px" height="200px" frameborder="0" allowfullscreen=""></iframe>
                </div>
            </div>
            <div class="py-2" :class="$auth.user().role ? 'bg-success' : 'bg-primary'">
                <p class="text-center">&copy; {{ new Date().getFullYear() }} <strong><router-link class="text-light text-decoration-none" to="/about">The Unexpected</router-link></strong>. All Right Reserved</p>
            </div>
        </footer>
        <div v-if="$auth.check()" id="app-modal-format" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Format tambahan</h5>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <guide></guide>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .slide-fade-enter-active, .slide-fade-leave-active{
        transition-duration: .3s;
        transition-property: height, opacity, transform;
        transition-timing-function: cubic-bezier(1.0, 0.5, 0.8, 1.0);
        overflow: hidden
    }
    .slide-fade-enter, .slide-fade-leave-active {
        opacity: 0;
        transform: translate(2em, 0)
    }
    #app-back-top {
        position: fixed;
        width: 55px;
        height: 55px;
        bottom: 25px;
        right: 25px;
        z-index: 9999;
        transition: all .3s ease
    }
    #app-back-top:hover {
        cursor: pointer;
        opacity: .8
    }
    .bg-au-ah{
        background: linear-gradient(to left top, #6DC28F, #0990ca),
        #0990ca
    }
    .foot-bl{ background-color: #0499A6 }
    .foot-gr{ background-color: #50B971 }
</style>

<script>
    export default {
        data: () => ({
            sauce: process.env.MIX_APP_URL,
            height: 0,
            searchApp: '',
            resize: false
        }),
        mounted(){
            if(window.innerWidth <= 992) this.resize = true
            else this.resize = false

            window.addEventListener('resize', e => {
                if(e.target.innerWidth <= 992) this.resize =  true
                else this.resize = false
            })
            $(window).scroll(function(){
                if ($(this).scrollTop() > 100) $('#app-back-top').fadeIn()
                else $('#app-back-top').fadeOut()
            })
        },
        methods: {
            before(el){
                this.height = getComputedStyle(el).height
            },
            enter(el){
                const { height } = getComputedStyle(el)

                el.style.height = this.height
                setTimeout(() => {
                    el.style.height = height
                })
            },
            after(el){
                el.style.height = 'auto'
            },
            btnSearchApp(){
                if(this.searchApp != '')
                    this.$router.push({ path: '/home?q='+this.searchApp })
            },
            openAppModal(){
                $('#app-modal-format').modal()
            },
            appToTop(){
                $('body,html').animate({
                    scrollTop: 0
                }, 250)
            }
        }
    }
</script>
