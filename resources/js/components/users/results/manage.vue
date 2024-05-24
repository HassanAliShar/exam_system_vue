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
                      <th>Paper Name</th>
                      <th>Obtained Marks</th>
                      <th>Correct Answers</th>
                      <th>Wrong Answers</th>
                      <th>Passing Percentage</th>
                      <th>Your Percentage</th>
                      <th>Result</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in list" :key="item.id">
                      <td>{{ item.user.name }}</td>
                      <td>{{ item.paper.name }}</td>
                      <td>{{ item.obtained_marks }}</td>
                      <td>{{ item.correct_answer }}</td>
                      <td>{{ item.wrong_answer }}</td>
                      <td>{{ item.passing_marks }}%</td>
                      <td>{{ item.percentage }}%</td>
                      <td>{{ item.status }}</td>
                      <td>
                        <router-link :to="'/users/exams/result-view/'+item.id" class="btn btn-info mr-2">View</router-link>
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
      loged_in_user : localStorage.getItem('user'),
      user_id : null,
      list : [],
      loading : false,
      token : localStorage.getItem('token')
    }
  },
  mounted() {
    this.token = localStorage.getItem('token')
    this.user_id = JSON.parse(this.loged_in_user).id
    this.fecthData();
  },
  methods: {
    fecthData(){
      axios.get('/api/users/exams/results/'+this.user_id,{
        headers: {
          'Authorization': `Bearer ${this.token}`
        }
      })
      .then(res => {
        this.list = res.data.data
        console.log(this.list);
      });
    }
  }
}
</script>
