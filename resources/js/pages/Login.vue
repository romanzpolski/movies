<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header text-center">Login page</div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error">
                    <p>Error with credentials</p>
                </div>
                <div v-else>
                    <p class="card-text">Use your registered email and password</p>
                </div>
                <br/>
                <form autocomplete="off" @submit.prevent="login" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" v-model="password" required>
                    </div>
                    <button type="submit" class="btn btn-outline-success">Log In</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                email: null,
                password: null,
                has_error: false
            }
        },
        mounted() {
            //
        },
        methods: {
            login() {

                var app = this
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password
                    },
                    success: function() {
                        const redirectTo = 'movies'
                        this.$router.push({name: redirectTo})
                    },
                    error: function() {
                        app.has_error = true
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            }
        }
    }
</script>
