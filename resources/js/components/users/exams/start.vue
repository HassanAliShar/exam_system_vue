<template>
    <!-- <div class="container"> -->
        <!-- main bootstrap panel container -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Solve Your Exam</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" v-for="(item, index) in questions" :key="index">
                                    <!-- question start here -->
                                    <div class="col-md-12 row" style="border-bottom: 2px solid gray;margin-bottom: 10px;" >
                                        <div class="form-group col-md-10">
                                            <h4>
                                                <strong class="badge badge-info mr-3">Q No {{index+1}} : </strong>{{ questions[index].question }}
                                            </h4>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">Marks {{ questions[index].marks }}</label>
                                        </div>
                                        <div class="col-md-12" v-if="questions[index].question_type == 'single'">
                                            <div class="row options" id="">
                                                <div class="form-group col-md-3" v-for="(opt, i) in questions[index].options" :key="i">
                                                    <input type="radio" required v-model="questions[index].answer" :value="i+1" :id="index+'_'+i+1">
                                                    &nbsp; &nbsp;
                                                    <label v-if="i == 0" :for="index+'_'+i+1"><span class="badge badge-primary p-2">A</span> {{ questions[index].options[i].opt }}</label>
                                                    <label v-if="i == 1" :for="index+'_'+i+1"><span class="badge badge-primary p-2">B</span> {{ questions[index].options[i].opt }}</label>
                                                    <label v-if="i == 2" :for="index+'_'+i+1"><span class="badge badge-primary p-2">C</span> {{ questions[index].options[i].opt }}</label>
                                                    <label v-if="i == 3" :for="index+'_'+i+1"><span class="badge badge-primary p-2">D</span> {{ questions[index].options[i].opt }}</label>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" v-else>
                                            <div class="row options" id="">
                                                <div class="form-group col-md-3" v-for="(opt, i) in questions[index].options" :key="i">
                                                    <input type="checkbox" required v-model="questions[index].answers[i]" :value="i+1" :id="index+'_'+i+1">
                                                    &nbsp; &nbsp;
                                                    <label v-if="i == 0" :for="index+'_'+i+1"><span class="badge badge-primary p-2">A</span> {{ questions[index].options[i].opt }}</label>
                                                    <label v-if="i == 1" :for="index+'_'+i+1"><span class="badge badge-primary p-2">B</span> {{ questions[index].options[i].opt }}</label>
                                                    <label v-if="i == 2" :for="index+'_'+i+1"><span class="badge badge-primary p-2">C</span> {{ questions[index].options[i].opt }}</label>
                                                    <label v-if="i == 3" :for="index+'_'+i+1"><span class="badge badge-primary p-2">D</span> {{ questions[index].options[i].opt }}</label>

                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!-- questions end here  -->
                                </div>
                                <div class="col-md-12">
                                    <button v-if="questions.length > 0" class="btn btn-primary float-right" @click="UpdateData">Update</button>
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
            this.getQuestion();

            console.log(this.questions);
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

            getQuestion(){
                axios.get('/api/papers/questions/list/3')
                .then((response)=>{
                    response.data.forEach(element => {
                        let ans;
                        let opts = [];
                        if(element.question_type == 'single'){
                            ans = element.answer;
                        }else{
                            ans = element.answer.split(',');
                        }
                        // console.log( typeof ans);
                        if(element.option1 != null){
                            opts.push(
                                {
                                    opt : element.option1
                                }
                            );
                        }
                        if(element.option2 != null){
                            opts.push(
                                {
                                    opt : element.option2
                                }
                            );
                        }
                        if(element.option3 != null){
                            opts.push(
                                {
                                    opt : element.option3
                                }
                            );
                        }
                        if(element.option4 != null){
                            opts.push(
                                {
                                    opt : element.option4
                                }
                            );
                        }
                        this.questions.push({
                            question : element.question,
                            paper_id : element.paper_id,
                            choice : element.choice,
                            options : opts,
                            question_type : element.question_type,
                            answer :  typeof ans != 'object' ? ans : null,
                            answers : typeof ans == 'object' ? ans : [],
                            marks : element.marks
                        });
                    });
                })
            },

            initializeSelect2() {
                $(this.$refs.select).select2()
                    .on('change', (event) => {
                    this.updateAnswer(this.index, event.target.value);
                });
            },

            UpdateData(){
                axios.post('/api/papers/questions/update/'+this.id,
                    this.questions
                )
                .then((response)=>{
                    toastr.success(response.data.message);
                    // this.questions = [];
                })
            }
        }
    }
</script>
<style>
    .radio-container {
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 22px;
      user-select: none;
    }
    .radio-container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
    }
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
      border-radius: 50%;
    }
    .radio-container:hover input ~ .checkmark {
      background-color: #ccc;
    }
    .radio-container input:checked ~ .checkmark {
      background-color: #2196F3;
    }
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }
    .radio-container input:checked ~ .checkmark:after {
      display: block;
    }
    .radio-container .checkmark:after {
      top: 9px;
      left: 9px;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: white;
    }
  </style>
