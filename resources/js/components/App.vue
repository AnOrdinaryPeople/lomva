<template>
    <div>
        <div id="app-back-top" class="text-light text-center rounded-circle pt-3" :class="$auth.user().role ? 'bg-primary' : 'bg-success'" style="display: none" @click="appToTop">
            <font-awesome :icon="['fas', 'angle-up']" size="lg" />
        </div>
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm" :class="$auth.user().role ? 'bg-success' : 'bg-primary'">
            <router-link class="navbar-brand" to="/"><img :src="sauce+'/img/ini.png'" width="75" height="30" /></router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul v-if="$auth.check()" class="navbar-nav mr-auto">
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
                            <router-link class="dropdown-item" to="/profile"><font-awesome :icon="['far', 'user']" /> Profil</router-link>
                            <a class="dropdown-item" href="#" @click.prevent="$auth.logout()"><font-awesome icon="sign-out-alt" /> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <div :class="$auth.check() ? (!resize ? 'row' : '') : ''">
                <div v-if="$auth.check()" :class="!resize ? 'col-2 bg-white position-sticky overflow-auto shadow-sm' : 'invisible'" :style="!resize ? 'height: 100vh;top: 0' : ''">
                    <nav v-if="!resize" class="nav nav-pills flex-column pt-3">
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
                </div>
                <div :class="$auth.check() ? (!resize ? 'col-10 py-4 px-4' : 'container py-4') : 'container py-4'">
                    <transition name="slide-fade" mode="out-in" @beforeLeave="before" @enter="enter" @afterEnter="after">
                        <router-view></router-view>
                    </transition>
                </div>
            </div>
        </div>
        <footer class="py-2 text-center text-light" :class="$auth.user().role ? 'bg-success' : 'bg-primary'">
            <p id="footer-desc">&copy;</p>
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
            document.getElementById('footer-desc').innerHTML += ` ${new Date().getFullYear()} <strong><a class="text-light" href="http://smkbpi.sch.id/" target="_blank">SMK BPI</a></strong>. All Right Reserved`
            
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
