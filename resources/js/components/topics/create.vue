<template>
   <div class="container">
       <form @submit="formSubmit" enctype="multipart/form-data" >
        <!-- <form @submit="formSubmit" enctype="multipart/form-data"> -->

       <!-- selecting the subject, topic and the challenge (which was set by the user ) and using the challenge_id (that is the 
       value of the challenge) to insert into challenge_id which is in the questions table -->

            <!-- the topic selection for querying the database for where condition in the controller -->

          <!-- the challenge selection for querying the database for where condition in the controller -->
          <br>
           <div class="form-group">
               <br>
            <label for="subject"> Choose Subject</label> 
            <br>
            
            
            <select name="" v-model="subject" id="" v-on:change="selectedSubject" class="form-control">
                <!-- <option value="1" selected disabled> Select the Subject</option> -->
                <option v-for="(subject, index) in subjects" :key="index" :value="subject.id" id="subject.id"> 
                    {{subject.subject}}
                </option>                      
            </select>
        </div>



       <!-- the Question -->
           <div class="form-group">
               <label for="question"> Topic</label>
               <input type="text" name="" id="" v-model="topic" placeholder="Enter your Subject" class="form-control">
           </div>

           <div class="form-group">
               <label for="question">Description</label>
               <input type="text" name="" id="" v-model="description" placeholder="Enter Description" class="form-control">
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
          
            subject: 1,
            description:'',
            topic: '',
            subjects: [],
        }
    },
    mounted(){
        this.SubjectMounted();
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

        selectedSubject : function()
        {

        },
        
        formSubmit : function(e)
        {

            e.preventDefault();
            const config = {
                headers: {'contents-type' : 'multipart/form-data'}
            }
            alert('form is submitted')
           

            var formdata = new FormData();
            formdata.append('topic', this.topic);
            formdata.append('description', this.description);
            formdata.append('subject_id', this.subject);

            

            axios.post('/api/topics', formdata)
            .then(res=>{
                console.log(res)
                this.message = "Subject has been created successfully";
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
