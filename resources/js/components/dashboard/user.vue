<template>
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>User Dashboard</h1>
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
                                        <h3>{{ total_exams }}</h3>

                                        <p>Total Exams </p>
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
                                        <h3>{{ upcoming_exams }}</h3>

                                        <p>UpComing Exams</p>
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
                                        <h3>{{ expired_exams }}</h3>

                                        <p>Expired Exams</p>
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
                                        <h3>{{ given_exams }}</h3>
                                        <p>Given Exams</p>
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
            total_exams : 0,
            upcoming_exams : 0,
            expired_exams : 0,
            given_exams : 0,
            user : localStorage.getItem('user'),
            user_id : null,
        }
    },
    mounted() {
        this.token = localStorage.getItem('token');
        this.user_id = JSON.parse(this.user).id
        this.getUserDashboard();
    },
    methods: {
        getUserDashboard() {
            axios.get('/api/user/dashboard/'+this.user_id, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then((response) => {
                console.log(response.data);
                this.total_exams = response.data.total_exams ?? 0,
                this.upcoming_exams = response.data.upcoming_exams ?? 0,
                this.expired_exams = response.data.expired_exams ?? 0,
                this.given_exams = response.data.given_exams ?? 0
            })
        }
    }
}
</script>
