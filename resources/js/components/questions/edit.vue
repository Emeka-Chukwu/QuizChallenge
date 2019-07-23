<template>
   <div class="container">
       <form  @submit.prevent="submitForm" enctype="multipart/form-data" >

       <!-- selecting the subject, topic and the challenge (which was set by the user ) and using the challenge_id (that is the 
       value of the challenge) to insert into challenge_id which is in the questions table -->
       <div class="form-group">
            <label for="subject"> Choose Subject</label> 
            <br>
            <select name="" v-model="subject" id="" v-on:change="selectedSubject"  class="form-control">
                <option v-for="(subject, index) in subjects" :key="index" :value="subject.id" id="subject.id"> 
                    {{subject.subject}}
                </option>                      
            </select>
        </div>

            <!-- the topic selection for querying the database for where condition in the controller -->
         <div class="form-group">
            <label for="topic"> Choose Topic</label> 
            <br>
            <select name="" v-model="topic" id="" @change="selectedTopic" class="form-control">               
                <option v-for="(topic, index) in topics" :key="index" :value="topic.id" id="topic.id"> 
                    {{topic.topic}}
                </option>                
            </select>
        </div>

          <!-- the challenge selection for querying the database for where condition in the controller -->
         <div class="form-group">
            <label for="challenges"> Choose Challenges</label> 
            <br>
            <select name="" v-model="challenge" id="" v-on:change="selectedChallenge" class="form-control">
                <option v-for="(challenge, index) in challenges" :key="index" :value="challenge.id" id="challenge.id">
                    {{challenge.challenge}}
                </option>                                
            </select>
        </div>



       <!-- the Question -->
           <div class="form-group">
               <label for="question">Question</label>
               <input type="text" name="" id="" v-model="question" placeholder="Enter your Question" class="form-control">
           </div>
           <!-- the  answers -->
           <!-- choice one -->
           <div class="form-group">
               <label for="choiceone">Choice One</label>
               <input type="text" name="" id="" v-model="choiceone" placeholder="Enter Choice One" class="form-control">
           </div>
                <!-- the choice two -->
           <div class="form-group">
               <label for="choicetwo">Choice Two</label>
               <input type="text" name="" id="" v-model="choicetwo" placeholder="Enter Choice Two" class="form-control">
           </div>
                <!-- the choice three -->
           <div class="form-group">
               <label for="choicethree">Choice Three</label>
               <input type="text" name="" id="" v-model="choicethree" placeholder="Enter Choice Three" class="form-control">
           </div>
                <!-- the choice four -->
           <div class="form-group">
               <label for="choicefour">Choice Four</label>
               <input type="text" name="" id="" v-model="choicefour" placeholder="Enter Choice Four" class="form-control">
           </div>
                <!-- the correct choice  -->
           <div class="form-group">
               <label for="correct"></label>
               <input type="number" name="" id="" v-model="correctchoice" placeholder="Enter the number of the correct choice" class="form-control">
           </div>

           <div class="form-group">
               <label for="correct"></label>
               <input type="text" name="" id="" v-model="explanation" placeholder="Your choice description" class="form-control">
           </div>

           <div class="form-group">
               <input type="submit" value="Create" class="btn btn-primary">
           </div>
       </form>
        
   </div>
</template>

<script>
import { setTimeout } from 'timers';
export default {
    props:[],
    data(){
        return{
            subjects:[],
            subject: 1,
            challenge: 1,
            choiceone:'',
            choicetwo:'',
            choicethree:'',
            choicefour:'',
            correctchoice:1,
            question:'',
            challenges:[],
            topic: 1,
            options:'',
            topics:[],
            explanation:'',
            corrects : [],

        }
    },
    mounted(){
        this.fetchData();
        this.SubjectMounted();
        this.topicsMounted();
        this.challengesMounted();
    },
    methods:{
        // to be called immediately the page loads
       SubjectMounted: function()
        {
            axios.get('/api/subjects').then(res=>{
                this.subjects = res.data.data;
                // console.log(this.subjects);
                
                // console.log(res.data.data)
            }).catch(err =>{
                console.log(err)
            })
        },
        // to be called for topic if there is any change in the selection
        selectedSubject:function(){
            axios.get('api/topics/'+this.subject).then(res=>{
                // console.log(res.data.data)
                this.topics = ''
                this.topics = []
                this.topics = res.data.data;
                // console.log( this.topics)
            }).catch(err=>{
                console.log(err)
            })
        },
        // to be called immediately the page loads 
        topicsMounted: function(){
            axios.get('api/topics/'+this.subject).then(res=>{
                this.topics = res.data.data;

                // console.log(this.topics)
            }).catch(err=>{
                console.log(err)
            })
        },
        //  for challenges and questions via eager loading
        selectedTopic: function(){
            axios.get('api/challenges/challenge/'+this.topic).then(res=>{
                this.challenges = res.data.data;
                // console.log(this.challenges)
            }).catch(err=>{
                console.log(err)
            })
        },
        //  for challenges and questions via eager loading

        challengesMounted: function(){
            axios.get('api/challenges/challenge/'+this.topic).then(res=>{
                this.challenges = res.data.data
                // console.log(this.challenges)
            }).catch(err=>{
                console.log(err)
            })
        },

        selectedChallenge: function(){
            alert(this.challenge)
        },

        fetchData : function(){
            axios.get('api/questions/show/'+this.$route.params.id)
            .then(res => {
                this.data = res.data.data;
                console.log(this.data.answer)
                this.question = this.data.question;
                this.choiceone = this.data.answer[0].answer;
                this.choicetwo = this.data.answer[1].answer;
                this.choicethree = this.data.answer[2].answer;
                this.choicefour = this.data.answer[3].answer;
                this.corrects = this.data.answer;
                this.explanation = this.data
                this.corrects.forEach(option => {
                    if(option.is_correct){
                        this.explanation = option.explanation;
                        console.log(option)
                    }
                    
                });

            // correctchoice:'',

            })
        },

        submitForm: function(e)
        {
            e.preventDefault();
            const config = {
                headers: {'contents-type' : 'multipart/form-data'}
            }
            var formdata = new FormData();
            formdata.append('question', this.question);
            formdata.append('challenge_id', this.challenge);
            formdata.append('correct_answer', this.correctchoice);
            formdata.append('choice_one', this.choiceone);
            formdata.append('choice_two', this.choicetwo)
            formdata.append('choice_three', this.choicethree);
            formdata.append('choice_four', this.choicefour);
            formdata.append('_method','put');

            var data =
                {'question':this.question, 'challenge_id': this.challenge, 'correct_answer':this.correctchoice,
                'choice_one' : this.choiceone, 'choice_two' : this.choicetwo, 'choice_three' : this.choicethree,
                'choice_four' : this.choicefour, 'explanation' : this.explanation}
            
          

            axios.put('/api/questions/'+this.$route.params.id, data)
            .then(res=>{
                this.message = "question has been updated successfully";
                console.log(res)
                // setTimeout(()=>this.$router.push('/index'), 2500)
            })
                .catch(err =>{
                    this.messageError = " question not submitted ";
                })
        },

    }

}
</script>

<style>

</style>
