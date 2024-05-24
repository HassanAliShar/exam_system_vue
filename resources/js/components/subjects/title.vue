<template>
    <div id="app">
  <div v-if="showModal">
    <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" @click="showModal=false">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Modal title</h4>
              </div>
              <div class="modal-body">
                modal body
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
  <button id="show-modal" @click.prevent="showModal = true">Show Modal</button>
</div>
  </template>


<script>

    export default {

        data(){
            return {
                name: 'Hassan',
                list : [],
                item:{
                    name: "Hassan Ali",
                    email: 'hassanalishar@gmail.com',
                    password: 'ali123@'

                },
                showModal: false ,
            }
        },
        mounted() {
            this.fecthData()

        },
        methods:{
            save(){
                console.log(this.item.name);
            },
            openModal(){
                this.addModalData = true
            },
            fecthData(){
                axios.get('/api/categories/list').then((response)=>{
                    console.log(response);
                    this.list = response.data
                })

            },
            update(){
            },
    //         showModal() {
    //   // Find the element with the ref and open the modal
    //   const modalElement = this.$refs.modalRef.$el;
    //   $(modalElement).modal('show');
    // },
        }
    }
</script>
