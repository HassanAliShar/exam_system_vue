<template>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1>All Assigned Exams</h1>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="container-fluid">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Exams</h3>
              </div>
              <div class="card-body">
                <table id="example" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>User Name</th>
                      <th>User Email</th>
                      <th>Subject</th>
                      <th>Paper Name</th>
                      <th>Marks</th>
                      <th>Passing Marks</th>
                      <th>Exam Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in list" :key="item.id">
                      <td>{{ item.user.name }}</td>
                      <td>{{ item.user.email }}</td>
                      <td>{{ item.paper.subject.name }}</td>
                      <td>{{ item.paper.name }}</td>
                      <td>{{ item.total_marks }}</td>
                      <td>{{ item.passing_marks }}</td>
                      <td>{{ item.from_date }}</td>
                      <td>
                        <span class="badge badge-success" v-if="item.status == '0' && formattedDateTime >= item.from_date && formattedDateTime <= item.to_date">
                            Ready
                        </span>
                        <span class="badge badge-success" v-if="item.status == '1' && formattedDateTime >= item.from_date && formattedDateTime <= item.to_date">
                            Completed
                        </span>
                        <span class="badge badge-danger" v-if="item.status && formattedDateTime > item.from_date && formattedDateTime > item.to_date">
                            Expired
                        </span>
                        <span class="badge badge-info" v-if="item.status && formattedDateTime < item.from_date && formattedDateTime < item.to_date">
                            Up Coming
                        </span>
                      </td>
                      <td>
                        <router-link v-if="item.status == '0' && formattedDateTime >= item.from_date && formattedDateTime <= item.to_date" :to="'/users/exams/start/'+item.id" class="btn btn-info mr-2">Start Exam</router-link>
                        <!-- <button class="btn btn-danger mr-2" @click="deleteExam(item.id)">Delete</button> -->
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
// import axios from 'axios';

export default {
  data() {
    return {
      list: [],
      loading: false,
      loged_in_user : localStorage.getItem('user'),
      user_id : null,
      formattedDateTime: this.getCurrentDateTime()
    };
  },
  mounted() {
    this.user_id = JSON.parse(this.loged_in_user).id
    this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        const response = await axios.get('/api/users/exam/'+this.user_id);
        this.list = response.data.map(item => ({
          ...item,
          satus: item.status // Initialize the toggle state
        }));
        console.log(this.list);
      } catch (error) {
        console.error('Error fetching data:', error);
      } finally {
        this.loading = false;
      }
    },

    getCurrentDateTime() {
      const date = new Date();
      const year = date.getFullYear();
      const month = String(date.getMonth() + 1).padStart(2, '0');
      const day = String(date.getDate()).padStart(2, '0');
      const hours = String(date.getHours()).padStart(2, '0');
      const minutes = String(date.getMinutes()).padStart(2, '0');
      const seconds = String(date.getSeconds()).padStart(2, '0');
      return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    },
    async deleteExam(id) {
      try {
        await axios.delete(`/api/exams/delete/${id}`);
        Swal.fire('Deleted!', 'Subject has been deleted.', 'success');
        this.fetchData();
      } catch (error) {
        console.error('Error deleting subject:', error);
      }
    },
    toggleButton(index) {
      this.list[index].status = !this.list[index].status;
      const status = this.list[index].status ? 0 : 1;
      console.log(status);
      axios.post(`/api/exams/status/${this.list[index].id}`, {
        status: status
      }).then((response)=>{
        console.log(response);
        toastr.success(response.data.message);
      })
    },
  },
};
</script>
