<template>
    <!-- set add new button on right side  -->
    <button class="btn btn-info float-right" id="show-modal">Add New subject</button>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="addModalLabel">Add subject</h5>
                    <button type="button" class="close float-right" @click="closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="addsubject">
                        <div class="form-group">
                            <label for="name">subject Name</label>
                            <input type="text" class="form-control" id="name" v-model="subject_name">
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
                    subject_name: ''
                },
                showAddModal: false,
                isModalOpen: false,
                token : localStorage.getItem('token'),
                modalId: null
            }
        },

        mounted() {
            this.token = localStorage.getItem('token')
            $('#show-modal').on('click',function(){
                    $('#addModal').modal('show')
                }
            );
        },
        //get featchData function from parent

        methods: {
            addsubject(){
                axios.post('/api/subjects/add', {

                    name: this.subject_name,

                },{
                    headers: {
                        'Authorization': `Bearer ${this.token}`
                    }
                }).then((response)=>{
                    this.subject_name = '';
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
            }
        }
    }
</script>
