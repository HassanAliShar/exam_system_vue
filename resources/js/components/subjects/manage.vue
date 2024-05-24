<template>
    <!-- <div class="container"> -->
        <!-- main bootstrap panel container -->
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Subjects</h1>
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
                            <h3 class="card-title">All Subjects</h3>
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>subject Id</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in list" :key="item.id">
                                        <td>{{ item.id }}</td>
                                        <td>{{ item.name }}</td>
                                        <td>
                                            <button class="btn btn-info mr-2" @click="editsubject(item.id)">Edit</button>
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
        <EditModal @editsubject="fecthData()" :subjectName="local_subject_name" :id="subject_id"/>
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
                    subject_name: "",
                },
                local_subject_name : '',
                subject_id : '',
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
            editsubject(id){
                axios.get('/api/subjects/edit/'+id,
                    {
                        headers: {
                            'Authorization': `Bearer ${this.token}`
                        }
                    }
                ).then((response)=>{
                    this.local_subject_name = response.data.name;
                    this.subject_id = response.data.id
                    $('#editModal').modal('show')
                })
            },

            getsubjectName(){
                return this.item.subject_name
            },
            fecthData(){
                axios.get('/api/subjects/list',
                {
                    headers: {
                        'Authorization': `Bearer ${this.token}`
                    }
                })
                .then((response)=>{
                    // console.log(response);
                    this.list = response.data

                    // Swal.close();
                }).finally(()=>{
                    this.loading = false
                })

            },
            deletesubject (id){
                axios.delete('/api/subjects/delete/'+id,
                    {
                        headers: {
                            'Authorization': `Bearer ${this.token}`
                        }
                    }
                ).then((response)=>{
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
