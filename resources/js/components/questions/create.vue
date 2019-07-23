<template>
   <div class="container">
       <br>
       <form @submit="formSubmit" enctype="multipart/form-data" >
        <!-- <form @submit="formSubmit" enctype="multipart/form-data"> -->

       <!-- selecting the subject, topic and the challenge (which was set by the user ) and using the challenge_id (that is the 
       value of the challenge) to insert into challenge_id which is in the questions table -->
       <div class="form-group">
            <label for="subject"> Choose Subject</label> 
            <br>
            
            
            <select name="" v-model="subject" id="" v-on:change="selectedSubject" class="form-control">
                <!-- <option value="1" selected disabled> Select the Subject</option> -->
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
               <label for="correct">Correct Choice</label>
               <input type="number" name="" id="" v-model="correctchoice" placeholder="Enter the number of the correct choice" class="form-control">
           </div>

           <div class="form-group">
               <label for="correct"> Explanation</label>
               <input type="text" name="" id="" v-model="explanation" placeholder="Describe the reason for your answer" class="form-control">
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
            subjects: ['emeka', 'you'],
            subject: 1,
            challenge: 1,
            choiceone:'',
            choicetwo:'',
            choicethree:'',
            choicefour:'',
            correctchoice:'',
            question:'',
            challenges:[],
            topic: 1,
            options:'',
            topics:[],
            explanation:'',

        }
    },
    mounted(){
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
                
                console.log(res.data.data)
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
                console.log( this.topics)
            }).catch(err=>{
                console.log(err)
            })
        },
        // to be called immediately the page loads 
        topicsMounted: function(){
            axios.get('api/topics/'+this.subject).then(res=>{
                this.topics = res.data.data;

                console.log(this.topics)
            }).catch(err=>{
                console.log(err)
            })
        },
        //  for challenges and questions via eager loading
        selectedTopic: function(){
            axios.get('api/challenges/challenge/'+this.topic).then(res=>{
                this.challenges = res.data.data;
                console.log(this.challenges)
            }).catch(err=>{
                console.log(err)
            })
        },
        //  for challenges and questions via eager loading

        challengesMounted: function(){
            axios.get('api/challenges/challenge/'+this.topic).then(res=>{
                this.challenges = res.data.data
                console.log(this.challenges)
            }).catch(err=>{
                console.log(err)
            })
        },

        selectedChallenge: function(){
            alert(this.challenge)
        },

        formSubmit : function(e)
        {

            e.preventDefault();
            const config = {
                headers: {'contents-type' : 'multipart/form-data'}
            }
            alert('form is submitted')
           

            var formdata = new FormData();
            formdata.append('question', this.question);
            formdata.append('challenge_id', this.challenge);
            formdata.append('correct_answer', this.correctchoice);
            formdata.append('choice_one', this.choiceone);
            formdata.append('choice_two', this.choicetwo)
            formdata.append('choice_three', this.choicethree);
            formdata.append('choice_four', this.choicefour);
            formdata.append('explanation', this.explanation);

            axios.post('/api/questions', formdata)
            .then(res=>{
                console.log(res)
                this.message = "question has been created successfully";
                setTimeout(()=>this.$router.push('/questions'), 1500)
                // this.$router.push('/')
            }).catch(err =>{
                    this.messageError = " question not submitted ";
                })

                // this.$router.push('/')
                // console.log(formdata.entries)
            

        },

    }

}
</script>

<style>

</style>
