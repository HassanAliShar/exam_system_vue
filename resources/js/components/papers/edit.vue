<template>
     <!-- edit paper form  -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="editModalLabel">Edit paper</h5>
                    <button type="button" class="close float-right" @click="closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">paper Name</label>
                            <input type="text" class="form-control" id="name" v-model="paper_name">
                        </div>
                        <div class="form-group mt-3">
                            <button type="button" @click="updatepaper" class="btn btn-primary">Update</button>
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
  props: ['paperName', 'id'],
  emits: ['editpaper'],

  data() {
    return {
      paper_name:'',
      token: localStorage.getItem('token'),
    };
  },
    mounted() {
        this.token = localStorage.getItem('token')
        // Update paper_name when paperName prop changes
        this.paper_name = this.paperName;
    },

    watch: {
        // Watch for changes in the paperName prop and update paper_name accordingly
        paperName(newValue) {
            this.paper_name = newValue;
        }
    },

  methods: {
    closeModal() {
      $('#editModal').modal('hide');
    },

    updatepaper() {
        axios.post('/api/papers/update/'+this.id, {
            name: this.paper_name
        }, {
            headers: {
                Authorization: `Bearer ${this.token}`
            }
        }).then((response)=>{
            this.paper_name = '';
            // show sweetalert message
            Swal.fire(
                'Updated!',
                'paper has been updated.',
                'success'
            )
            $('#editModal').modal('hide');
            props: ['editpaper'],
            this.$emit('editpaper');
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
