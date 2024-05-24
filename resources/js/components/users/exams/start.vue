<template>
    <!-- <div class="container"> -->
        <!-- main bootstrap panel container -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="col-12">
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
                                            <label for="number_of_question">Enter Quantions No {{index+1}} </label>
                                            <input type="text" required v-model="questions[index].question" id="number_of_question" class="form-control" placeholder="Enter your Numbers of Questions">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">Selection Optoins</label>
                                            <select class="form-control" @change="getOptions($event,index)">
                                                <option
                                                    v-for="value in [2, 3, 4]"
                                                    :key="value"
                                                    :value="value"
                                                    :selected="questions[index].options.length === value"
                                                >
                                                    {{ value }}
                                                </option>
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
                                                        <option v-for="i in questions[index].options.length"
                                                            :selected="parseInt(questions[index].answer) == i"
                                                            :key="i"
                                                            :value="i"
                                                        >
                                                            {{i}}
                                                        </option>
                                                    </select>
                                                    <span v-else v-for="i in questions[index].options.length" :key="i" :value="i">
                                                        <br>
                                                        <input type="checkbox"
                                                        :checked="questions[index].answers.includes(i)"
                                                        v-model="questions[index].answers"
                                                        :value="i" id=""> {{i}}
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
