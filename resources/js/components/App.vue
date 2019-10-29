<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <router-link class="navbar-brand" :to="{name: 'home'}">{{ appName }}</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li v-if="!$auth.check()" class="nav-item">
                        <router-link class="nav-link" to="/dashboard">Dashboard</router-link>
                    </li>
                    <li class="nav-item">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <input class="form-control" type="text" v-model="searchApp" placeholder="Cari postingan..">
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" @click.prevent="btnSearchApp">Cari</button>
                            </div>
                        </div>
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
            <div :class="$auth.check() ? 'row' : ''">
                <div v-if="$auth.check()" class="col-2 bg-white position-sticky overflow-auto shadow-sm" style="height: 100vh;top: 0">
                    <nav class="nav nav-pills flex-column">
                        <router-link class="nav-link" to="/dashboard">Dashboard</router-link>
                        <router-link class="nav-link" to="/add-post">Buat postingan baru</router-link>
                        <router-link class="nav-link" to="/my-post">Postinganku</router-link>
                    </nav>
                </div>
                <div :class="$auth.check() ? 'col-10 py-4 px-4' : 'container py-4'">
                    <transition name="slide-fade" mode="out-in" @beforeLeave="before" @enter="enter" @afterEnter="after">
                        <router-view></router-view>
                    </transition>
                </div>
            </div>
        </div>
        <footer class="bg-white py-2 text-center">
            <p id="footer-desc">&copy;</p>
        </footer>
    </div>
</template>

<script>
    export default {
        data: () => ({
            appName: process.env.MIX_APP_NAME,
            sauce: process.env.MIX_APP_URL,
            height: 0,
            searchApp: ''
        }),
        mounted(){
            document.getElementById('footer-desc').innerHTML += ` ${new Date().getFullYear()} SMK BPI. All Right Reserved`
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
            }
        }
    }
</script>
