<template>
    <div class="login-box m-auto">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1" style="text-decoration: none">
                    <b>Create</b> Account
                </a>
            </div>
            <div class="card-body" style="background :url('../../../../public/images/logo-global.jpg'); background-size: cover;">
                <p class="login-box-msg">Sign Up to start your session</p>
                <form @submit.prevent="register">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" v-model="name" required autofocus placeholder="Enter Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
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
                        <button type="submit" class="btn btn-dark btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->
                <p class="mt-5 bg-light">
                    <router-link to="/login" class="btn btn-link">Login</router-link>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</template>

<script>
export default {
    name: "Register",

    data() {
        return {
            name: '',
            email: '',
            password: ''
        }
    },
    methods: {
        register() {
            if (this.name && this.email && this.password) {
                axios.post('api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password
                }).then((response) => {
                    this.name = ''
                    this.email = ''
                    this.password = ''
                    localStorage.setItem('token', response.data.token)
                    localStorage.setItem('user', JSON.stringify(response.data.user))
                    toastr.success(response.data.message)
                    this.$router.push({ name: 'login' })
                }).catch((error) => {
                    // toastr.error(error.response.data.message.email)
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
