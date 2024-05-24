<template>
    <!-- <div class="container"> -->
        <!-- main bootstrap panel container -->
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Papers</h1>
                        <addModal @subjectAdded="fecthData()" />
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
                                        <th>Subject Name</th>
                                        <th>Paper Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in list" :key="item.id">
                                        <td>{{ item.subject.name }}</td>
                                        <td>{{ item.name }}</td>
                                        <td>
                                            <button class="btn btn-info mr-2" @click="editsubject(item.id)">Edit</button>
                                            <router-link :to="'/papers-questions/'+item.id" class="btn btn-info mr-2" >Questions</router-link>
                                            <button class="btn btn-danger mr-2" @click="deletesubject(item.id)">Delete</button>
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
        <EditModal @editpaper="fecthData()" :paperName="local_paper_name" :id="paper_id"/>
</template>

<script>
import addModal from './addModal.vue';
import EditModal from './edit.vue';
import toastr from 'toastr';
import Swal from 'sweetalert2';
    export default {
        components: {
            addModal,
            EditModal
        },
        data(){
            return {
                name: 'Hassan',
                list : [],
                item:{
                    paper_name: "",
                },
                local_paper_name : '',
                paper_id : '',
                loading : false,
            }
        },
        mounted() {
            this.fecthData();
        },

        destroyed() {
            $('#example').DataTable().destroy();
        },
        methods:{
            editsubject(id){
                axios.get('/api/papers/edit/'+id).then((response)=>{
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
                axios.get('/api/papers/list').then((response)=>{
                    // console.log(response);
                    this.list = response.data

                    // Swal.close();
                }).finally(()=>{
                    this.loading = false
                })

            },
            deletesubject (id){
                axios.delete('/api/papers/delete/'+id).then((response)=>{
                    // show sweetalert message
                    Swal.fire(
                        'Deleted!',
                        'subject has been deleted.',
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
