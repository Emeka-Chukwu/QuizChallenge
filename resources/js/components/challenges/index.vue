<template>
    <div class="containe">
        <div class=""><br>
            <router-link :to="`/challenges/create`">Start Challenge</router-link>
            <br>
            <br>
        </div>
        <!-- the subject selection for querying the database for where conditon in the topicsController -->
        <!-- <form @submit="formSubmit" enctype="multipart/form-data" > -->
        <br>
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

      <br><br>
      <br>

        <!-- the table that will house the questions with edit and delete links  -->

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Challenge</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <tr v-for="(challenge, index) in challenges" :key="index">
                    <td>{{index}}</td>
                    <td>{{challenge.challenge}}</td>
                    <!-- <td><span class="glyphicon glyphicon-envelope"><router-link :to="{name: 'questionsEdit', id: question.id}"></router-link></span></td> -->
                    <td><span btn btn-primary><router-link :to="`/challenges/${challenge.id}/edit`">Edit</router-link></span></td>
                    <td><span btn btn-primary><router-link :to="`/challenges/${challenge.id}/delete`">Delete</router-link></span></td>

                    <!-- <td><span btn btn-primary><router-link to="'/questions/'+question.id+'/edit'"></router-link></span></td> -->

                </tr>
            </thead>
        </table>
    </div>
</template>

<script>
export default {
    data(){
        return{
            subjects: [],
            subject: 1,
           
            inputchallenge:[],
            challenges:[],
            topic : 1,
            topics : [],
            challenge_id: 0,
        }
    },
    mounted(){
        this.SubjectMounted();
        this.topicsMounted();
        this.fetchdata();
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
        
        selectedTopic : function()
        {
            this.categorizedChallenge();
        },

        fetchdata : function()
        {
            axios.get('api/challenges/')
            .then(res=>{
                this.challenges = res.data.data;
                console.log(res)
                this.challenge_id = res.data.id;
                console.log(this.challenge_id)
                // console.log(res.data.challenge)
            })
            .catch(err=>{
                console.log(err)
            })
        },

        categorizedChallenge : function()
        {
            axios.get('api/challenges/challenge/'+this.topic)
            .then(res=>{
                this.challenges = res.data.data;
                console.log(res)
                this.challenge_id = res.data.id;
                console.log(this.challenge_id)
                // console.log(res.data.challenge)
            })
            .catch(err=>{
                console.log(err)
            })
        }
    }
}
</script>

<style>

</style>
