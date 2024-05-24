<template>
    <!-- <div class="container"> -->
        <!-- main bootstrap panel container -->
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit Paper</h1>
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
                            <h3 class="card-title">Edit Paper Info</h3>
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
                                            <button type="submit" class="btn btn-primary float-right" id="btn-submit">Update</button>
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
            };
        },
        mounted() {
            this.getExams();
            this.getPaper();
        },

        methods: {
            SaveData(){
                axios.post('/api/exams/update',{
                    from_date: this.from_date,
                    to_date:this.to_date,
                    attempt:this.attempts,
                    paper_id:this.paper_id,
                    id:this.id,
                    marked_attempts : 0,
                    total_marks :this.total_marks,
                    passing_marks: this.passing_marks
                })
                .then((response)=>{
                    toastr.success(response.data.message);
                    this.$router.push({ name: 'userPapers' });
                    this.questions = [];
                })
            },

            getPaper(){
                axios.get('/api/exams/'+this.id)
                .then((response)=>{
                    console.log(response.data);
                    this.from_date = response.data.from_date;
                    this.to_date = response.data.to_date;
                    this.attempts = response.data.attempt;
                    this.total_marks = response.data.total_marks;
                    this.passing_marks = response.data.passing_marks;
                    this.paper_id = response.data.paper_id;
                });
            },

            getExams(){
                console.log("Get Papers is called");
                axios.get('/api/papers/list')
                .then((response)=>{
                    this.papers = response.data
                })
            }
        }
    }
</script>
