<!-- bootstrap 4 sidebar start  here-->
<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../../index3.html" class="brand-link">
            <img src="../../../../public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Exam System</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul v-if="role == 1" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/subject" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Subjects
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/papers" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Papers
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/users/manage" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/users/papers" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Exams
                            </p>
                        </router-link>
                    </li>
                </ul>
                <ul v-if="role == 2" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/users/exams" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Exams
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/users/exams/results" class="nav-link">
                            <i class="nav-icon fas fa-pen"></i>
                            <p>
                                Results
                            </p>
                        </router-link>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

</template>

<script>
import { RouterLink } from 'vue-router';

export default {
    name: "Sidebar",
    data() {
        return {
            user : localStorage.getItem('user') ?? null,
            role : null,
        }
    },

    mounted() {
        this.role = JSON.parse(this.user).role_id;
        // console.log(this.role);
    }
}
</script>
