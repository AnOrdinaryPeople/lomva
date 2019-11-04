<template>
    <div>
        <div id="app-back-top" class="bg-secondary text-light text-center rounded-circle pt-3" style="display: none" @click="appToTop">
            <i id="top" class="material-icons">keyboard_arrow_up</i>
        </div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
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
                                    <button class="btn btn-outline-secondary" @click.prevent="btnSearchApp">Cari</button>
                                </div>
                            </div>
                        </form>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" to="/home">Beranda</router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" :to="$auth.user().role === 1 ? '/teacher/questionnaire' : '/questionnaire'">Kuesioner</router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" to="/chat">Chat</router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" to="/add-post">Buat postingan baru</router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <router-link class="nav-link" to="/my-post">Postinganku</router-link>
                    </li>
                    <li v-if="resize" class="nav-item">
                        <a class="nav-link" href="#" @click.prevent="openAppModal()">Format tambahan</a>
                    </li>
                </ul>
                <ul v-else class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/home">Beranda</router-link>
                    </li>
                    <li class="nav-item">
                        <form>
                            <div class="input-group">
                                <input class="form-control" type="text" v-model="searchApp" placeholder="Cari postingan..">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" @click.prevent="btnSearchApp">Cari</button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
                <ul v-if="!$auth.check()" class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/login">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/register">Register</router-link>
                    </li>
                </ul>
                <ul v-else-if="$auth.check()" class="navbar-nav ml-auto">
                    <li class="nav-item dropdown dropleft">
                        <a id="profDropdown" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                            {{ $auth.user().name }} <img class="img-fluid rounded-circle" :src="$auth.user().avatar ? $auth.user().avatar : sauce+'/img/default.png'" width="30" height="30" />
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profDropdown">
                            <router-link class="dropdown-item" to="/profile">Profil</router-link>
                            <a class="dropdown-item" href="#" @click.prevent="$auth.logout()">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <div :class="$auth.check() ? (!resize ? 'row' : '') : ''">
                <div v-if="$auth.check()" :class="!resize ? 'col-2 bg-white position-sticky overflow-auto shadow-sm' : 'invisible'" :style="!resize ? 'height: 100vh;top: 0' : ''">
                    <nav v-if="!resize" class="nav nav-pills flex-column pt-3">
                        <router-link class="nav-link" to="/home">Beranda</router-link>
                        <router-link class="nav-link" :to="$auth.user().role === 1 ? '/teacher/questionnaire' : '/questionnaire'">Kuesioner</router-link>
                        <router-link class="nav-link" to="/chat">Chat</router-link>
                        <router-link class="nav-link" to="/add-post">Buat postingan baru</router-link>
                        <router-link class="nav-link" to="/my-post">Postinganku</router-link>
                        <a class="nav-link" href="#" @click.prevent="openAppModal()">Format tambahan</a>
                    </nav>
                </div>
                <div :class="$auth.check() ? (!resize ? 'col-10 py-4 px-4' : 'container py-4') : 'container py-4'">
                    <transition name="slide-fade" mode="out-in" @beforeLeave="before" @enter="enter" @afterEnter="after">
                        <router-view></router-view>
                    </transition>
                </div>
            </div>
        </div>
        <footer class="bg-white py-2 text-center">
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
        z-index: 9999
    }
    #app-back-top:hover {
        cursor: pointer;
        background-color: #595C5E!important
    }
</style>

<script>
    import Guide from './Guide'

    export default {
        components: {
            Guide
        },
        data: () => ({
            sauce: process.env.MIX_APP_URL,
            height: 0,
            searchApp: '',
            resize: false
        }),
        mounted(){
            document.getElementById('footer-desc').innerHTML += ` ${new Date().getFullYear()} <a href="http://smkbpi.sch.id/" target="_blank">SMK BPI</a>. All Right Reserved`
            
            if(window.innerWidth <= 768) this.resize = true
            else this.resize = false

            window.addEventListener('resize', e => {
                if(e.target.innerWidth <= 768) this.resize =  true
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
                this.$router.push({ path: '/dashboard?q='+this.searchApp })
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
