<template>
    <div class="login-box mt-5 m-auto mt-5">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1" style="text-decoration: none">
                    <b>Exam</b>System
                </a>
            </div>
            <div class="card-body" style="background :url('../../../../public/images/logo-global.jpg'); background-size: cover;">
                <p class="login-box-msg">Sign in to start your session</p>
                <form @submit.prevent="Login">
                    <div class="input-group mb-3">
                    <input type="email" class="form-control" v-model="email" required autofocus placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    </div>
                    <div class="input-group mb-3">
                    <input type="password" class="form-control" v-model="password" required placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-12 mb-3">
                        <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">
                            Remember Me
                        </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-dark btn-block">LogIn</button>
                    </div>
                    <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->
                <p class="mt-5 bg-light">
                    <router-link to="/register" class="btn btn-link">Register</router-link>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</template>

<script>
import toastr from 'toastr'

export default {
    name: "Login",

    data() {
        return {
            email: '',
            password: ''
        }
    },

    mounted() {

    },

    methods: {
        Login() {
            if (this.email && this.password) {
                axios.post('api/login', {
                    email: this.email,
                    password: this.password
                }).then((response) => {
                    localStorage.setItem('token', response.data.token)
                    localStorage.setItem('user', JSON.stringify(response.data.user))
                    if (response.data.user.role == 'admin') {
                        this.$router.push({ name: 'admin_dashboard' })
                    }
                    else {
                        this.$router.push({ name: 'user_dashboard' })
                    }

                }).catch((error) => {
                    console.log(error)
                })
            }
            else {
                toastr.error('All fields are required')
            }
        }
    }
}
</script>
