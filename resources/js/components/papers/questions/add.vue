<template>
    <!-- <div class="container"> -->
        <!-- main bootstrap panel container -->
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Add New Questions</h1>
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
                            <h3 class="card-title">Add Questions</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary float-right" @click="addQuestions">Add New</button>
                                </div>
                                <div class="col-md-12" v-for="(item, index) in questions" :key="index">
                                    <!-- question start here -->
                                    <div class="col-md-12 row" style="border-bottom: 2px solid gray;margin-bottom: 10px;" >
                                        <div class="form-group col-md-10">
                                            <label for="number_of_question">Enter Quantions No {{index+1}} </label>
                                            <input type="text" required v-model="questions[index].question" id="number_of_question" class="form-control" placeholder="Enter your Numbers of Questions">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">Selection Optoins</label>
                                            <select class="form-control" @change="getOptions($event,index)">
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row options" id="">
                                                <div class="form-group col-md-3" v-for="(opt, i) in questions[index].options" :key="i">
                                                    <label for="">Enter Option {{i+1}}</label>
                                                    <input type="text" required class="form-control" v-model="questions[index].options[i].opt" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Select Question Type</label>
                                                    <select class="form-control" required v-model="questions[index].question_type" ref="select" id="">
                                                        <option value="single" selected >Single</option>
                                                        <option value="multiple">Multiple</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Select Currect Answer</label>
                                                    <select v-if="questions[index].question_type == 'single'" class="form-control select2 ans_opt" required v-model="questions[index].answer" ref="select" id="">
                                                        <option v-for="i in questions[index].options.length" :key="i" :value="i">{{i}}</option>
                                                    </select>
                                                    <span v-else v-for="i in questions[index].options.length" :key="i" :value="i">
                                                        <br>
                                                        <input type="checkbox" v-model="questions[index].answers" :value="i" id=""> {{i}}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="">Enter Quantions Marks?</label>
                                                    <input type="number" required class="form-control" v-model="questions[index].marks" placeholder="">
                                                </div>
                                                <br>
                                                <hr>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!-- questions end here  -->
                                </div>
                                <div class="col-md-12">
                                    <button v-if="questions.length > 0" class="btn btn-primary float-right" @click="SaveData">Check Info</button>
                                </div>
                            </div>
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
        data() {
            return {
                id: this.$route.params.id,
                questions : []
            };
        },
        mounted() {
            this.initializeSelect2();
        },

        methods: {
            addQuestions(){
                this.questions.push({
                    question : '',
                    paper_id : this.id,
                    options : [
                        {
                            opt : ''
                        },
                        {
                            opt : ''
                        }
                    ],
                    choice : '',
                    question_type : '',
                    answer : '',
                    answers : [],
                    marks : ''
                });
            },

            initializeSelect2() {
                $(this.$refs.select).select2()
                    .on('change', (event) => {
                    this.updateAnswer(this.index, event.target.value);
                });
            },

            getOptions(event, index) {
                const selectedValue = event.target.value;
                this.questions[index].options = [];
                for (let i = 1; i <= selectedValue; i++) {
                    this.questions[index].options.push({
                        opt: '',
                    });
                }
            },

            getType(event,index){
                const selectedValue = event.target.value;
                if(selectedValue == 'multiple'){
                    this.questions[index].answers = [];
                }
            },

            SaveData(){
                axios.post('/api/papers/questions/add',
                this.questions
                )
                .then((response)=>{
                    toastr.success(response.data.message);
                    this.questions = [];
                })
            }
        }
    }
</script>
