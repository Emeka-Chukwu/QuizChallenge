<template>
    <div>
        <br>
        <h3>New Challenge</h3>

        <form  @submit="formSubmit" enctype="multipart/form-data">
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
                
            </div>
            <div class="form-group">
                <input type="submit" value="Create h" class="btn btn-primary">
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
            started: 0,
            completed:0
        }
    },
    mounted(){
        this.SubjectMounted();
        this.topicsMounted();
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
        
        selectedTopic : function()
        {

        },

     

         formSubmit: function(e)
        {
            e.preventDefault();
            alert('submitting form')

            var formdata = new FormData();
            formdata.append('subject', this.subject);
            formdata.append('topic', this.topic);
            formdata.append('challenge', this.challenge);
            formdata.append('user_id', this.userId)
            formdata.append('started', this.started)
            formdata.append('completed', this.completed);
           
            axios.post('/api/challenges', formdata)
            .then(res=>{
                this.message = "Challenge has been created successfully";
                console.log(this.message)
                console.log(res)
                //  setTimeout(()=>this.$router.push('/questions'), 1500)
                }).catch(err =>{
                    this.messageError = " Challenge not created ";
                    console.log(err)
                })
            // })

        },
        

    }

}
</script>

<style>

</style>
