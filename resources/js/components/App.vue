<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <router-link class="navbar-brand" :to="{name: 'home'}">{{ appName }}</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul v-if="$auth.user().role === 0" class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/home-user">Home</router-link>
                    </li>
                </ul>
                <ul v-else-if="$auth.user().role === 1" class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/home-teacher">Home</router-link>
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
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click.prevent="$auth.logout()">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container py-4">
            <transition name="slide-fade" mode="out-in" @beforeLeave="before" @enter="enter" @afterEnter="after">
                <router-view></router-view>
            </transition>
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
            height: 0
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
            }
        }
    }
</script>
