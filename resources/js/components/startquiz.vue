<template>
<div class="quiz">
    
    <div v-if="introStage">
        <h3>
            <h2>
            Welcome to the quiz : by {{userName}}
            </h2>
            <br><br>
        </h3>
        <div class="text-capitalize text-danger">
            {{description}}
        </div>


    </div>
    <div v-if="questionStage">
        <div >
               
             
            <h3>
               <small><span>{{currentQuestion+1}}</span></small> {{questions[currentQuestion].question}}
            </h3>
            <br>
             <div v-for="(mainanswer, index) in questions[currentQuestion].answer" :key="mainanswer.id"> 
                <h5>
                <input type="radio" :name="'currentQuestion'+index" :id="'current'+index" :value="mainanswer.answer" v-model="answermodel">
                <label :for="'current'+index">{{mainanswer.answer}}</label><br>
            </h5> 
            </div>

               <!-- <b> {{indexQ}}</b> -->
               {{datashuffled}}
            
            <button @click="nextQuestion">Answer </button>
        </div>

    </div>

    <div v-if="resultStage">
        congrats you scored {{correct}} out of {{questions.length}}
        <p v-if="percent >= 50"> 
            your percentage : {{percent}}
        </p>

    </div>
    <router-link :to="{name: 'emeka'}">quiz</router-link>
    http://127.0.0.1:8000/challenges/1/quiz#/
                    <!-- <td><span btn btn-primary><router-link :to="`/questions/${1}/edit`">emeka</router-link></span></td> -->
    

</div>

    
</template>

<script>
export default {
    
    props:['userId','challengeName', 'userName'],
    mounted(){
        this.fetchData()
    },
    data(){
        return{
            questions:[],
            answers : [],
            datashuffled :[],
            answersassigning: [],
            introStage:true,
            questionStage: false,
            resultStage : false,
            currentQuestion:0,
            correct : 0,
            percent : null,
            challengeId:1,
            answermodel: '',
            correctAnswers: [],
            answerCheck: [],
            description:'',
            questionsNumber: '',
            

        }
    },
    methods: {
        fetchData : function()
        {
            axios.get(`/api/questions/${this.challengeId}`).then(res=>{
                // console.log(res)
                this.questions = res.data.data;
                this.questionsNumber = this.questions[this.currentQuestion].question;
                // console.log(this.questions)
                this.questionStage = true;
                this.questions.forEach((question, index) => {
                    this.answerCheck = question.answer;
                    // console.log(this.answerCheck);l
                    // this.answerCheck = question[0];
                    // console.log(index)
                    // console.log(this.answerCheck)
                    this.answerCheck.forEach(correct => {
                        if(correct.is_correct === 1)
                            this.correctAnswers[index] = correct.answer;
                    });
                });
                            console.log(this.correctAnswers)
               
            })
        },
        
        nextQuestion: function(e)
        {
           
            this.answers[this.currentQuestion] = this.answermodel;
            // console.log(this.answers)
            if(this.currentQuestion+1 ==this.questions.length){
                // call the function to excute an get the total marks scored by the user
                this.handleResults();
                this.questionStage = false;
                this.resultStage = true;
            } else {
                this.currentQuestion++;
                this.questions[this.currentQuestion].question
                this.datashuffled = this.questions[this.currentQuestion].answer;
                console.log(this.datashuffled.length)
                for(let i = this.datashuffled.length - 1; i>0; i--){
                    const j = Math.floor(Math.random()*this.datashuffled.length);


                    console.log(j)
                    // const temp = this.datashuffled[i];
                    // console.log(temp)
                    // this.datashuffled = this.datashuffled[j];
                    // this.datashuffled[j] = temp;
                }
                // this.datashuffled = this.datashuffled.shuffle();
            }
        },

        handleResults: function(){
            this.questions.forEach((element,index) =>{
                if(this.answers[index] === this.correctAnswers[index]) this.correct++;
            })
            console.log(this.answers)
            this.percent = ((this.correct/this.questions.length) *100).toFixed(2);
        }
    }
}
</script>

<style>

</style>
