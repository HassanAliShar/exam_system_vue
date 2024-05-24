<template>
    <!-- set add new button on right side  -->
    <button class="btn btn-info float-right" id="show-modal">Add New Paper</button>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="addModalLabel">Add New Paper</h5>
                    <button type="button" class="close float-right" @click="closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="addsubject">
                        <div class="form-group">
                            <label for="name">Select Subject</label>
                            <select class="form-control" id="name" v-model="item.subject_id">
                                <option v-for="subject in subjects" :key="subject.id" :value="subject.id">
                                    {{subject.name}}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">subject Name</label>
                            <input type="text" class="form-control" id="name" v-model="item.name">
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="closeModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import toastr from 'toastr';
 export default {
        props: ['subjectAdded'],

        emits: ['subjectAdded'],
        data(){
            return {
                item : {
                    name: '',
                    subject_id: '',
                },
                subjects : [],
                showAddModal: false,
                isModalOpen: false,
                modalId: null,
                token : localStorage.getItem('token')
            }
        },

        mounted() {
            this.token = localStorage.getItem('token')
            $('#show-modal').on('click',function(){
                    $('#addModal').modal('show')
                }
            );

            this.getSubjects();
        },
        //get featchData function from parent

        methods: {
            addsubject(){
                axios.post('/api/papers/add', {
                    name: this.item.name,
                    subject_id: this.item.subject_id
                },{
                    headers: {
                        'Authorization': `Bearer ${this.token}`
                    }
                }).then((response)=>{
                    this.name = '';
                    // show toastr success message
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        positionClass: 'toast-top-right',
                        timeOut: 3000 // Duration in milliseconds
                    };
                    toastr.success("subject Added Successfully");
                    $('#addModal').modal('hide');
                    props: ['subjectAdded'],
                    this.$emit('subjectAdded');
                })
            },

            openModal(id){
                console.log("Open Modal is called");
                this.addModalData = true
                this.modalId = id
            },


            closeModal(){
                this.addModalData = false
                this.modalId = null
            },

            closeModal(){
                $('#addModal').modal('hide');
            },

            getSubjects(){
                axios.get('/api/subjects/list',
                    {
                        headers: {
                            'Authorization': `Bearer ${this.token}`
                        }
                    }
                ).then((response)=>{
                    this.subjects = response.data
                })
            }
        }
    }
</script>
