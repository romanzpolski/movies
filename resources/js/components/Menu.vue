<template>
    <div class="container">
        <nav id="nav" class="navbar navbar-expand-lg navbar-light bg-light">
            <h2><a class="navbar-brand" href="/">Movies App</a></h2>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!--UNLOGGED-->
                    <li class="nav-item" v-if="!$auth.check()" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
                        <router-link class="nav-link"  :to="{ name : route.path }" :key="key">
                            {{route.name}}
                        </router-link>
                    </li>
                    <!--LOGGED USER-->
                    <li class="nav-item" v-if="$auth.check()" v-for="(route, key) in routes.user" v-bind:key="route.path">
                        <router-link class="nav-link"   :to="{ name : route.path }" :key="key">
                            {{route.name}}
                        </router-link>
                    </li>
                    <!--LOGOUT-->
                    <li class="nav-item" v-if="$auth.check()">
                        <a class="nav-link" href="#" @click.prevent="$auth.logout()">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                routes: {
                    // UNLOGGED
                    unlogged: [
                        {
                            name: 'Register',
                            path: 'register'
                        },
                        {
                            name: 'Log In',
                            path: 'login'
                        }
                    ],
                    // LOGGED USER
                    user: [
                        {
                            name: 'Search',
                            path: 'search'
                        }
                    ]
                }
            }
        },
        mounted() {
//
        }
    }
</script>
