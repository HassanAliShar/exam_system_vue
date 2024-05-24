<template>
    <!-- <div class="container"> -->
        <!-- main bootstrap panel container -->
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Users</h1>
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
                            <h3 class="card-title">All Papers</h3>
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in list" :key="item.id">
                                        <td>{{ item.name }}</td>
                                        <td>{{ item.email }}</td>
                                        <td>
                                            <!-- <button class="btn btn-info mr-2" @click="editsubject(item.id)">Edit</button> -->
                                            <router-link :to="'/users/assign-paper/'+item.id" class="btn btn-info mr-2" >Assign Exams</router-link>
                                            <button class="btn btn-danger mr-2" @click="deleteUser(item.id)">Delete</button>
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
                name: 'Hassan',
                list : [],
                loading : false,
                token : localStorage.getItem('token')
            }
        },
        mounted() {
            this.token = localStorage.getItem('token')
            this.fecthData();
        },

        destroyed() {
            $('#example').DataTable().destroy();
        },
        methods:{
            fecthData(){
                axios.get('/api/users/list',{
                    headers: {
                        'Authorization': `Bearer ${this.token}`
                    }
                }).then((response)=>{
                    // console.log(response);
                    this.list = response.data

                    // Swal.close();
                }).finally(()=>{
                    this.loading = false
                })

            },
            deleteUser(id){
                axios.delete('/api/users/delete/'+id,{
                    headers: {
                        'Authorization': `Bearer ${this.token}`
                    }
                }).then((response)=>{
                    // show sweetalert message
                    Swal.fire(
                        'Deleted!',
                        response.data.message ?? 'User has been deleted.',
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
</script>
