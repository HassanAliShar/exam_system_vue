<template>
    <!-- <div class="container"> -->
        <!-- main bootstrap panel container -->
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Paper Questions</h1>
                        <router-link :to="`/papers-questions/add/${paper_id}`" class="btn btn-primary float-right">Add Questions</router-link>
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
                            <h3 class="card-title">All Questions</h3>
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Paper Name</th>
                                        <th>Question</th>
                                        <th>Option1</th>
                                        <th>Option2</th>
                                        <th>Option3</th>
                                        <th>Option4</th>
                                        <th>Answer</th>
                                        <th>Marks</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in list" :key="item.id">
                                        <td>{{ item.paper.name }}</td>
                                        <td>{{ item.question }}</td>
                                        <td>{{ item.option1 }}</td>
                                        <td>{{ item.option2 }}</td>
                                        <td>{{ item.option3 }}</td>
                                        <td>{{ item.option4 }}</td>
                                        <td>{{ item.answer }}</td>
                                        <td>{{ item.marks }}</td>
                                        <td>{{ item.question_type }}</td>
                                        <td>
                                            <router-link :to="'/papers-questions/edit/'+item.id" class="btn btn-info mr-2">Edit</router-link>
                                            <button class="btn btn-danger mr-2" @click="deleteQuestion(item.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
        data(){
            return {
                list : [],
                item:{
                    paper_name: "",
                },
                local_paper_name : '',
                paper_id : '',
                loading : false,
                paper_id : '',
                token : localStorage.getItem('token')
            }
        },
        mounted() {
            this.token = localStorage.getItem('token')
            this.fecthData();
            this.paper_id = this.$route.params.id
        },

        destroyed() {
            $('#example').DataTable().destroy();
        },
        methods:{
            editsubject(id){
                axios.get('/api/papers/edit/'+id,
                    {
                        headers: {
                            'Authorization': `Bearer ${this.token}`
                        }
                    }
                ).then((response)=>{
                    this.local_paper_name = response.data.name;
                    this.paper_id = response.data.id
                    $('#editModal').modal('show')
                })
            },

            getsubjectName(){
                return this.item.paper_name
            },
            fecthData(){
                // create loading sweetalert message
                // Swal.fire({
                //     title: 'Loading...',
                //     allowOutsideClick: false,
                //     allowEscapeKey: false,
                //     didOpen: () => {
                //         Swal.showLoading()
                //     }
                // })
                axios.get('/api/papers/questions/list/'+this.$route.params.id,
                    {
                        headers: {
                            Authorization: `Bearer ${this.token}`
                        }
                    }
                ).then((response)=>{
                    // console.log(response);
                    this.list = response.data
                    console.log(this.list);
                    // Swal.close();
                }).finally(()=>{
                    this.loading = false
                })

            },
            deleteQuestion(id){
                axios.delete('/api/papers/questions/delete/'+id,
                    {
                        headers: {
                            'Authorization': `Bearer ${this.token}`
                        }
                    }
                ).then((response)=>{
                    Swal.fire(
                        'Deleted!',
                        response.data.message,
                        'success'
                    )
                    this.fecthData();
                })
            },
            update(){
            },
            showModal() {
                this.showModal = true;
            },
        }
    }
</script>./add.vue
