<template>
    <!-- <div class="container"> -->
        <!-- main bootstrap panel container -->
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Assign Paper</h1>
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
                            <h3 class="card-title">Add Paper Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form @submit.prevent="SaveData">
                                        <div class="card-body row" id="question-box">
                                            <div class="col-md-12 row" style="border-bottom: 2px solid gray;margin-bottom: 10px;">
                                                <input type="hidden" v-model="id">
                                                <div class="form-group col-md-6">
                                                    <label for="from_date">From Date</label>
                                                    <input type="datetime-local" required v-model="from_date" id="from_date" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="to_date">To Date</label>
                                                    <input type="datetime-local" required v-model="to_date" id="to_date" class="form-control">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="attempts">Total Attempts</label>
                                                    <input type="number" required v-model="attempts" id="attempts" class="form-control" placeholder="Enter Number Of attempts">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="">Exam Marks</label>
                                                    <input type="number" required v-model="total_marks" class="form-control" placeholder="Enter Total Marks">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="">Passing Percent %</label>
                                                    <input type="number" required v-model="passing_marks" class="form-control" placeholder="Enter Passing Percent">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">Select User Paper</label>
                                                    <select class="form-control" v-model="paper_id">
                                                        <option :value="paper.id" v-for="paper in papers">{{paper.name}}</option>
                                                    </select>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary float-right" id="btn-submit">Assign</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    import toastr from 'toastr';
    import Swal from 'sweetalert2';
    export default {
        components: {
        },
        data() {
            return {
                id: this.$route.params.id,
                from_date: '',
                to_date: '',
                attempts: '',
                total_marks: '',
                passing_marks: '',
                papers : [],
                paper_id : '',
                token : localStorage.getItem('token')
            };
        },
        mounted() {
            this.token = localStorage.getItem('token')
            this.getExams();
        },

        methods: {
            SaveData(){
                // show loading sweetalert
                Swal.fire({
                    title: 'Loading...',
                    text: 'Please wait while adding new paper',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                axios.post('/api/users/assign_exams/add',{
                    from_date: this.from_date,
                    to_date:this.to_date,
                    attempt:this.attempts,
                    paper_id:this.paper_id,
                    user_id:this.id,
                    marked_attempts : 0,
                    total_marks :this.total_marks,
                    passing_marks: this.passing_marks
                },{
                    headers: {
                        'Authorization': `Bearer ${this.token}`
                    }
                })
                .then((response)=>{
                    this.from_date = '';
                    this.to_date = '';
                    this.attempts = '';
                    this.total_marks = '';
                    this.passing_marks = '';
                    Swal.close();
                    toastr.success(response.data.message);
                    this.questions = [];
                }).catch((error)=>{
                    Swal.close();
                })
            },

            getExams(){
                axios.get('/api/papers/list',{
                    headers: {
                        'Authorization': `Bearer ${this.token}`
                    }
                })
                .then((response)=>{
                    this.papers = response.data
                })
            }
        }
    }
</script>
