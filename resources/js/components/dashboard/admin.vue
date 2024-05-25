<template>
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Admin Dashboard</h1>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dashboard</h3>
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ total_user }}</h3>

                                        <p>Total Users</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <router-link to="/users/manage" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ total_exams }}</h3>

                                        <p>Total Exams</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <router-link to="/papers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ assigned_exams }}/{{ total_assigned }}</h3>

                                        <p>Active Exams/ Total Exams</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <router-link to="/users/papers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{ total_subjects }}</h3>
                                        <p>Total Subject</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <router-link to="/subject" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: "Dashboard",
    data() {
        return {
            token: localStorage.getItem('token'),
            total_user : 0,
            total_exams : 0,
            assigned_exams : 0,
            total_subjects : 0,
            total_assigned : 0
        }
    },
    mounted() {
        this.token = localStorage.getItem('token');
        this.getDashboard();
    },
    methods: {
        getDashboard() {
            axios.get('/api/admin/dashboard', {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then((response) => {
                this.total_user = response.data.total_user,
                this.total_exams = response.data.total_exams,
                this.assigned_exams = response.data.assigned_exams,
                this.total_subjects = response.data.total_subjects,
                this.total_assigned = response.data.total_assigned
            })
        }
    }
}
</script>
