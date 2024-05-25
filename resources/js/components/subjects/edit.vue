<template>
     <!-- edit subject form  -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="editModalLabel">Edit subject</h5>
                    <button type="button" class="close float-right" @click="closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">subject Name</label>
                            <input type="text" class="form-control" id="name" v-model="cat_name">
                        </div>
                        <div class="form-group mt-3">
                            <button type="button" @click="updatesubject" class="btn btn-primary">Update</button>
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
import { ref } from 'vue'; // Import ref from Vue
import Swal from 'sweetalert2';

export default {
  props: ['subjectName', 'id'],
  emits: ['editsubject'],

  data() {
    return {
      cat_name:'',
      token: localStorage.getItem('token'),
    };
  },
    mounted() {
        // Update cat_name when subjectName prop changes
        this.cat_name = this.subjectName;

        this.token = localStorage.getItem('token');
    },

    watch: {
        // Watch for changes in the subjectName prop and update cat_name accordingly
        subjectName(newValue) {
            this.cat_name = newValue;
        }
    },

  methods: {
    closeModal() {
      $('#editModal').modal('hide');
    },

    updatesubject() {
        axios.post('/api/subjects/update/'+this.id, {
            name: this.cat_name
        }, {
            headers: {
                Authorization: `Bearer ${this.token}`
            }
        }).then((response)=>{
            this.cat_name = '';
            // show sweetalert message
            Swal.fire(
                'Updated!',
                'subject has been updated.',
                'success'
            )
            $('#editModal').modal('hide');
            props: ['editsubject'],
            this.$emit('editsubject');
        }).catch((error)=>{
            console.log(error);
            if (error.response) {
                const messages = error.response.data.message;
                if (messages && typeof messages === 'object') {
                    Object.values(messages).forEach((messageArray) => {
                    messageArray.forEach((message) => {
                        toastr.error(message);
                    });
                    });
                } else {
                    toastr.error(messages);
                }
            } else {
                toastr.error('An error occurred. Please try again later.');
            }
        })
    },
  },
};
</script>
