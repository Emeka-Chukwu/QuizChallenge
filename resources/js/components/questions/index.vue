<template>
    <div>
        <br>
        <div>
            <router-link to="/questions/create" class="btn btn-primary">Add a Question</router-link>
        </div>
        <br>
        <!-- the subject selection for querying the database for where conditon in the topicsController -->
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


        <!-- the table that will house the questions with edit and delete links  -->

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Questions</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <tr v-for="(question, index) in questions" :key="index">
                    <td>{{index}}</td>
                    <td>{{question.question}}</td>
                    <!-- <td><span class="glyphicon glyphicon-envelope"><router-link :to="{name: 'questionsEdit', id: question.id}"></router-link></span></td> -->
                    <td><span ><router-link class="btn btn-primary" :to="`/questions/${question.id}/edit`">Edit</router-link></span></td>
                    <td><span><router-link class="btn btn-danger" :to="`/questions/${question.id}/delete`">Delete</router-link></span></td>

                    <!-- <td><span btn btn-primary><router-link to="'/questions/'+question.id+'/edit'"></router-link></span></td> -->

                </tr>
            </thead>
        </table>
    </div>
</template>

<script>
export default {
    props:[],
    data(){
        return{
            subjects: [],
            subject: 1,
            challenge: 1,
            topic: 1,
            topics: [],
            challenges: [],
            questions : [],
        }
    }, mounted(){
        this.SubjectMounted();
        this.topicsMounted();
        this.challengesMounted();
        this.questionsMounted();
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
            this.questionsMounted();
        },

        questionsMounted : function(){
            axios.get('api/questions/'+this.challenge).then(res=>{
                this.questions = res.data.data
                console.log(this.questions)
            }).catch(err=>{
                console.log(err)
            })
        }
    }
}

</script>

<style>

</style>
