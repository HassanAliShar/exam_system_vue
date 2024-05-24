<template>
    <div id="app" class="wrapper">
            <Navbar v-if="requiresAuth"/>
            <Sidebar v-if="requiresAuth"/>
            <main id="js-page-content" role="main" class="page-content">
                <router-view></router-view>
            </main>
            <Footer v-if="requiresAuth" />
    </div>
</template>

<script>
import Sidebar from './Sidebar.vue';
import Header from './Header.vue';
import Footer from './Footer.vue';
import Navbar from './navbar.vue'; // Ensure correct casing
import Login from './../auth/login.vue'; // Ensure correct casing
import { watchEffect } from 'vue';
import { useRouter } from 'vue-router';

export default {
    components: {
        Sidebar,
        Header,
        Footer,
        Navbar,
        Login
    },

    data() {
        return {
            current_year: new Date().getFullYear(),
            user: localStorage.getItem('user') ?? null,
            requiresAuth: false
        }
    },

    mounted() {
        // Check the initial route
        this.checkAuth();

        // Watch for route changes
        const router = useRouter();
        watchEffect(() => {
            this.requiresAuth = router.currentRoute.value.meta.requiresAuth;
        });
    },

    methods: {
        checkAuth() {
            const router = useRouter();
            this.requiresAuth = router.currentRoute.value.meta.requiresAuth;
        }
    }
}
</script>

