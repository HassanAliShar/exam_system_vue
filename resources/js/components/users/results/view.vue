<template>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="col-12 mt-5">
                    <div class="card prints">
                        <div class="card-header">
                            <h3 class="card-title">Result Your Exam</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive" v-if="result">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Name</th>
                                                <th>{{ result.user ? result.user.name : 'N/A' }}</th>
                                            </tr>
                                            <tr>
                                                <th>Exam Name</th>
                                                <th>{{ result.paper ? result.paper.name : 'N/A' }}</th>
                                            </tr>

                                            <tr>
                                                <th>Obtained Marks</th>
                                                <th>{{ result.obtained_marks ?? 'N/A' }}</th>
                                            </tr>
                                            <tr>
                                                <th>Correct Answers</th>
                                                <th>{{ result.correct_answer ?? 'N/A' }}</th>
                                            </tr>
                                            <tr>
                                                <th>Wrong Answers</th>
                                                <th>{{ result.wrong_answer ?? 'N/A' }}</th>
                                            </tr>
                                            <tr>
                                                <th>Passing Percentage</th>
                                                <th>{{ result.passing_marks ?? 'N/A' }}%</th>
                                            </tr>
                                            <tr>
                                                <th>Your Percentage</th>
                                                <th>{{ result.percentage ?? 'N/A' }}%</th>
                                            </tr>
                                            <tr>
                                                <th>Result</th>
                                                <th>
                                                    <span v-if="result.status == 'Pass'" class="badge badge-success">
                                                        {{ result.status }}
                                                    </span>
                                                    <span v-else class="badge badge-danger">
                                                        {{ result.status }}
                                                    </span>
                                                </th>
                                            </tr>
                                        </table>
                                    </div>
                                    <div v-else>
                                        Loading...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button @click="printDiv" class="btn btn-primary">Print</button>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            id: this.$route.params.id,
            result: null,
            token : localStorage.getItem('token')
        };
    },

    mounted() {
        this.token = localStorage.getItem('token')
        this.getResult();
    },

    methods: {
        getResult() {
            axios.get(`/api/users/exams/results/single/${this.id}`,{
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
                .then((response) => {
                    this.result = response.data.data;
                })
                .catch((error) => {
                    console.error('Error fetching result:', error);
                });
        },
        printDiv() {
            const printContents = document.querySelector('.prints').innerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload(); // Reload the page to restore the original content
        }
    }
}
</script>
