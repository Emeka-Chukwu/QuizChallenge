<template>
    <div>
        <h3>Edit Challenge</h3>

        <form action="" method="post" @submit.prevent="submitChallenge">
            <!-- value of the challenge) to insert into challenge_id which is in the questions table --> -->
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

            <!-- <div class="form-group">
                <select v-model="challenge" id="">
                    <option value="" disabled selected> select the challenge</option>
                    <option value="" v-for="(challenge, index) in challenges" :key="index">
                        {{question}}
                    </option>
                </select>
            </div> -->

            <div class="form-group">
                <label for="challenge"> Challenge </label>
                <input type="text" v-model="challenge" class="form-control" id="">
                <input type="hidden" v-model="subject">
                <input type="hidden" v-model="topic">
            </div>
            <div class="form-group">
                <input type="submit" value="Update" class="btn btn-primary">
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props:[
        'userId',
        
    ],
    data(){
        return{
            subjects: [],
            subject: 1,
           
            inputchallenge:[],
            challenge:'',
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

        },

        fetchdata : function()
        {
            alert(this.$route.params.id)
            axios.get('api/challenges/'+this.$route.params.id)
            .then(res=>{
                console.log(res)
                this.challenge = res.data.challenge;
                this.challenge_id = res.data.id;
                console.log(this.challenge_id)
                // console.log(res.data.challenge)
            })
            .then(err=>{
                console.log(err)
            })
        },

     

         submitChallenge: function(e)
        {
            e.preventDefault();

            var formdata = new FormData();
            formdata.append('subject', this.subject);
            formdata.append('topic', this.topic);
            formdata.append('challenge', this.challenge);
            formdata.append('user_id', this.userId)
            formdata.append('_method', 'put')
            axios.post('/api/challenges/'+this.challenge_id,formdata)
            .then(res=>{
                this.message = "Challenge has been updated successfully";
                console.log(this.message)
                console.log(res)
            })
                // setTimeout(()=>this.$router.push('/challenges'), 2500)
                .catch(err =>{
                    this.messageError = " Challenge not created ";
                })
            // })

        },
        

    }

}
</script>

<style>

</style>
