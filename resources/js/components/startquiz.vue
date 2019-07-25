<template>
<div class="quiz">
    
    <div v-if="introStage">
        <h3>
            <h4>
                <br>
        Host: {{userName}} <br>
            <!-- Id : {{userId}} -->
            </h4>
            <br>
        </h3>
        <div class="text-capitalize text-danger">
            {{description}}
        </div>


    </div>
    <div v-if="questionStage">
        <div >
               
             
            <h3>
               <small><span>No {{currentQuestion+1}})</span></small> {{questions[currentQuestion].question}}
            </h3>
            <br><br>
             <div v-for="(mainanswer, index) in questions[currentQuestion].answer" :key="mainanswer.id"> 
                <h5>
                <input type="radio" :name="'currentQuestion'+index" :id="'current'+index" :value="mainanswer.answer" v-model="answermodel">
                <label :for="'current'+index">{{mainanswer.answer}}</label><br>
            </h5> 
            </div>

               <!-- <b> {{indexQ}}</b> -->
               <!-- {{datashuffled}} -->
            
            <button @click="nextQuestion" class="btn-primary">Answer </button>
        </div>

    </div>

    <div v-if="resultStage">
        congrats you scored {{correct}} out of {{questions.length}}
        <p v-if="percent >= 50"> 
            your percentage : {{percent}}
        </p>

    </div>
    <!-- <router-link :to="{name: 'emeka'}">quiz</router-link> -->
    <!-- http://127.0.0.1:8000/challenges/1/quiz#/ -->
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
                        if(correct.is_correct === true)
                            this.correctAnswers[index] = correct.answer;
                    });
                });
                            console.log(this.correctAnswers)
               
            })
        },
        
        nextQuestion: function(e)
        {
            if(!this.answermodel =='')
            {
                this.answers[this.currentQuestion] = this.answermodel;
            // console.log(this.answers)
            this.answermodel = '';
            console.log(this.answermodel)
            if(this.currentQuestion+1 == this.questions.length){
                // call the function to excute an get the total marks scored by the user
                this.handleResults();
                this.questionStage = false;
                this.resultStage = true;
            } else {
                this.currentQuestion++;
                this.questions[this.currentQuestion].question
                this.datashuffled = this.questions[this.currentQuestion].answer;
                
                
                // this.datashuffled = this.datashuffled.shuffle();
            }
            }
            else{
                alert('please select an option')
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
